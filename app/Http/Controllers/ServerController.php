<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Docker\Container;
use App\Jobs\InitServer;
use App\Models\ExposedPort;
use App\Models\Server;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Server/Index", [
            "servers" => Server::all()->jsonSerialize(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Server/Create', [
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
        ]);
    
        $service = Service::where("uuid", $request->service)->firstOrFail();
        $server = Server::create([
            "uuid" => Str::uuid(),
            "name" => preg_replace('/[^a-zA-Z0-9_.-]/', '', $request->name),
            "service_id" => $service->id,
            "status_id" => 3,
            "user_id" => Auth::user()->id
        ]);
        dispatch(new InitServer($server));
        return redirect(route("servers.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $server = Server::where("uuid", $request->id)->firstOrFail();
        return Inertia::render("Server/Show", [
            "server" => $server
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
