<?php

use App\Models\ExposedPort;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exposed_ports', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger("number");
            $table->boolean("usable");
            $table->timestamps();
        });
        for($i = 25000; $i < 30000; $i++) ExposedPort::create([ "number" => $i, "usable" => true ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exposed_ports');
    }
};
