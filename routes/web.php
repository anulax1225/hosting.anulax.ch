<?php
use App\Docker\Docker;
use App\Docker\Container;
use App\Http\Controllers\ProfileController;
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
    return Inertia::render('Home');
})->name("home");

Route::get("/info", function() {
    $config = Docker::info();
    return Inertia::render('Info', [ "config" => $config ]);
})->name("docker.info");

Route::get("/spawn", function (Request $request) {
    return Inertia::render('Spawn');
})->name("docker.create");

Route::post("/spawn", function (Request $request) {
    $request->validate([
        "name" => "required|string",
        "port" => "required|string"
    ]);
    $container = Container::create($request->name,  [
        "Hostname" => "mincraft-". $request->name, 
        "Domainname" => $request->name, 
        "User" => "root",
        "Image" => "minecraft:latest",
        "OpenStdin" => true,
        "Tty" => true,
        "ExposedPorts" => [ "25565/tcp" => (object)[] ],
        "HostConfig" => [
            "PortBindings" => [ "25565/tcp" => [[ "HostPort" => $request->port ]] ],
        ]
    ]);
    $container->start();
    return redirect("/");
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
