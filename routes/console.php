<?php

use App\Docker\Container;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('create:user {name} {email} {password} {admin}', function ($name, $email, $password, $admin) {
    User::create([
        "name" => $name,
        "email" => $email,
        "password" => bcrypt($password),
        "admin" => $admin,
        "email_verified_at" => Carbon::now()
    ]);
})->purpose('Display an inspiring quote');

Artisan::command('exec {id}', function ($id) {
    try{
        $container = new Container($id);
        $exec = $container->exec(["apt install -y iproute2"]);
        Log::info(json_encode($exec->inspect(), JSON_PRETTY_PRINT));
        $exec->start();
        Log::info($container->logs());
        $exec = $container->exec(["echo hello"]);
        $data = $exec->inspect();
        Log::info(json_encode($data, JSON_PRETTY_PRINT));
        $exec->start();

    } catch (Exception $e) { Log::error(((object)$e)->getResponse()->getBody()); }

})->purpose('Display an inspiring quote');
