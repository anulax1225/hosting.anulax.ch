<?php

namespace App\Http\Middleware;

use App\Models\Server;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ResourceRules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $server = Server::where("uuid", $request->id)->first();
        if(!$server) return redirect(route("servers.index"))->withErrors(["error" => "Impossible de trouver ce server!"]);
        if(Auth::user()->id == $server->id || Auth::user()->admin) return $next($request);
        return redirect(route("servers.index"))->withErrors(["error" => "Vous n'avez d'autorisation d'access a se serveur!"]);
    }
}
