<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Docker\Container;
use App\Jobs\InitServer;
use App\Models\ExposedPort;
use App\Models\Server;
use App\Models\Service;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class ServerController extends Controller
{
    public function start(Request $request)
    {
        $server = Server::where("uuid", $request->id)->first();
        if($server->status_id >= 3) {
            try {
                $container = new Container($server->container);
                $container->start();
                $server->update([
                    "status_id" => 1,
                    "start" => Carbon::now()
                ]);
                return redirect()->back()->withErrors([ "message" => "Serveur lancé avec succès. Attendez quelque seconds avant de vous connectez." ]);
            } catch(Exception $e) { return redirect()->back()->withErrors([ "error" => "Impossible de démarré le serveur." ]); }

        } else { return redirect()->back()->withErrors([ "error" => "Serveur déjà ou entrain de démarré." ]); }
    }

    public function stop(Request $request)
    {
        $server = Server::where("uuid", $request->id)->first();
        if($server->status_id < 3) {
            try {
                $server->update([
                    "status_id" => 3,
                    "end" => Carbon::now()
                ]);
                $container = new Container($server->container);
                $container->stop();
                return redirect()->back()->withErrors([ "message" => "Serveur arrêté avec succès. Merci de votre visite." ]);
            } catch(Exception $e) { return redirect()->back()->withErrors([ "error" => "Impossible de d'arrêter le serveur." ]); }

        } else { return redirect()->back()->withErrors([ "error" => "Serveur déjà ou entrain de s'arrêter." ]); }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Server/Index", [
            "banner" => "/img/banner.gif",
            "servers" => (Auth::user()->admin ? Server::orderBy("start", "DESC")->orderBy("end", "DESC")->get() : Server::where("user_id", Auth::user()->id)->get())->jsonSerialize(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Server/Create', [
            "banner" => "/img/banner.jpg",
            "services" => Service::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "service" => "required|string",
            "launch" => "nullable"
        ]);

        $user = Auth::user();
        if(!$user->admin && count($user->server) >= 2) return redirect()->back()->withErrors(["error" => "Vous avez déjà trop de servers. Veillez en supprimer un!"]);
    
        $service = Service::where("uuid", $request->service)->first();
        if(!$service) return redirect()->back()->withErrors(["error" => "Impossible de trouver ce service!"]);
        $server = Server::create([
            "uuid" => Str::uuid(),
            "name" => preg_replace('/[^a-zA-Z0-9_.-]/', '', $request->name),
            "service_id" => $service->id,
            "status_id" => 3,
            "user_id" => Auth::user()->id
        ]);

        $config = config($server->service->config);
        $ports = explode("|", $server->service->ports);

        for ($i = 0; $i < count($ports); $i++) {
            $port = ExposedPort::where("usable", true)->first();
            if(!$port) {
                $server->exposedPorts()->update([ "usable" => true ]);
                $server->exposedPorts()->detach();
                $server->delete();
                return redirect()->back()->withErrors(["error" => "Aucune place libre pour votre server, réessayer plus tard."]);
            }
            $server->exposedPorts()->attach($port->id);
            $port->update(["usable" => false]);

            $config["ExposedPorts"][$ports[$i] . "/" . $server->service->protocol] = (object)[];
            $config["HostConfig"]["PortBindings"][$ports[$i] . "/" . $server->service->protocol] = [[ "HostPort" =>  "" . $port->number ]];
        }

        dispatch(new InitServer($server, $config, $request->launch ? true : false));
        return redirect(route("servers.index"))->withErrors([ "message" => "Serveur créer avec succès" . ($request->launch ? " et devrait se lancer d'une minute à l'autre." : ".") ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $server = Server::where("uuid", $request->id)->firstOrFail();
        
        return Inertia::render("Server/Show", [
            "banner" => "/img/banner.webp",
            "server" => $server->jsonSerialize()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:25",
        ]);

        $server = Server::where("uuid", $request->id)->first();
        $server->update([
            "name" => preg_replace('/[^a-zA-Z0-9_.-]/', '', $request->name)
        ]);
        return redirect()->back()->withErrors(["message" => "Nom changé avec succès."]);
    }

    public function makePublic(Request $request)
    {
        $server = Server::where("uuid", $request->id)->first();
        $server->update([
            "public" => !$server->public,
        ]);
        return redirect()->back()->withErrors(["message" => $server->public ? "Server rendu publiquement accéssible." : "Server rendu privé."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $server = Server::where("uuid", $request->id)->first();
        if($server->container) {
            try {
                $container = new Container($server->container);
                $data = $container->inspect()->State;
                if($data->Running || $data->Paused || $data->Restarting) $container->kill();
            } catch(Exception) { return redirect()->back()->withErrors(["error" => "Problème pour éteindre le serveur. Réessayer!"]); }
        }
        $server->exposedPorts()->update([ "usable" => true ]);
        $server->exposedPorts()->detach();
        $server->delete();
        return redirect(route("servers.index"))->withErrors(["message" => "Server supprimer avec succès."]);
    }
}
