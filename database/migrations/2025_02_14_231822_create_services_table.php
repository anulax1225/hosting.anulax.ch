<?php

use App\Models\Service;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string("name");
            $table->string("image");
            $table->string("config");
            $table->string("protocol");
            $table->string("ports");
            $table->timestamps();
        });

        Service::create([
            "uuid" => Str::uuid(),
            "name" => "Minecraft Java edition",
            "image" => "/img/minecraft-java.webp",
            "config" => "docker.minecraftJava",
            "protocol" => "tcp",
            "ports" => "25565"
        ]);

        Service::create([
            "uuid" => Str::uuid(),
            "name" => "Minecraft Bedrock edition",
            "image" => "/img/minecraft-bedrock.webp",
            "config" => "docker.minecraftBedrock",
            "protocol" => "udp",
            "ports" => "19132|19133"
        ]);

        Service::create([
            "uuid" => Str::uuid(),
            "name" => "Ark Survial Evolved",
            "image" => "/img/ark.jpeg",
            "config" => "docker.arkserver",
            "protocol" => "udp",
            "ports" => "27015|7777"
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
