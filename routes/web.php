<?php

use App\Docker\Container;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use React\Socket\FixedUriConnector;
use React\Socket\UnixConnector;



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get("/spawn", function (Request $request) {
    $connector = new FixedUriConnector(
        'unix:///var/run/docker.sock',
        new UnixConnector()
    );
    $browser = new Browser($connector);
    $browser->get('http://localhost/info')->then(function (ResponseInterface $response) {
    }, function (Exception $e) {
        echo 'Error: ' . $e->getMessage() . PHP_EOL;
    });

    return Inertia::render('Spawn');
});

Route::post("/spawn", function (Request $request) {
    $request->validate([
        "name" => "required|string",
        "port" => "required|string"
    ]);
    $container = (object)[];
    Container::create($request->name,  [
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
        ], 
        [
            "onSucces" => function ($c) use($container) {
                $container = $c;
                $container->start([
                    "onSucces" => function ($c, $data) {
                        return dd($c, $data);
                    },
                    "onError" => function($e) {
                        return dd($e);
                    }
                ]);
            },
            "onError" => function($e) {
                return dd($e);
            }
        ]
    );
});

Route::get('/dashboard', function () {
    exec("docker-compose up -d –force-recreate");
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
