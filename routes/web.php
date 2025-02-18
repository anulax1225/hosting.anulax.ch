<?php
use App\Docker\Docker;
use App\Docker\Container;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServerController;
use App\Http\Middleware\ResourceRules;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use React\Socket\FixedUriConnector;
use React\Socket\UnixConnector;



Route::get('/', function () {
    return Inertia::render('Home', [
        "banner" => "/img/banner.avif",
        "services" => Service::all(),
        "servers" => Server::where("public", true)->get()->jsonSerialize()
    ]);
})->name("home");

Route::get("/info", function() {
    $config = Docker::info();
    return Inertia::render('Info', [ "config" => $config ]);
})->name("docker.info");

Route::middleware(['auth'])->group(function () {
    Route::get("/servers/create", [ServerController::class, 'create'])->name("servers.create");
    Route::post("/servers", [ServerController::class, 'store'])->name("servers.store");
    Route::get("/servers", [ServerController::class, 'index'])->name("servers.index");

    Route::middleware(ResourceRules::class)->group(function() {
        Route::get("/servers/{id}", [ServerController::class, 'show'])->name("servers.show");
        Route::post("/servers/{id}/update", [ServerController::class, 'update'])->name("servers.update");
        Route::post("/servers/{id}/public", [ServerController::class, 'makePublic'])->name("servers.public");
        Route::delete("/servers/{id}", [ServerController::class, 'destroy'])->name("servers.destroy");
        Route::post("/servers/{id}/start", [ServerController::class, 'start'])->name("servers.start");
        Route::post("/servers/{id}/stop", [ServerController::class, 'stop'])->name("servers.stop");
    });

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
