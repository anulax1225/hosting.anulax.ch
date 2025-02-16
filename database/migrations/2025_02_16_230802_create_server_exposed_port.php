<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exposed_port_server', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id");
            $table->unsignedBigInteger("exposed_port_id")->unique();
            $table->timestamps();

            $table->foreign("server_id")->references("id")->on("servers");
            $table->foreign("exposed_port_id")->references("id")->on("exposed_ports");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exposed_port_server');
    }
};
