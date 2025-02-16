<?php

use App\Models\Spec;
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
        Schema::create('specs', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->unsignedTinyInteger("cpus");
            $table->unsignedBigInteger("memory");
            $table->unsignedBigInteger("storage");
            $table->timestamps();
        });

        Spec::create([
            "uuid" => Str::uuid(),
            "cpus" => 1,
            "memory" => 2000000000,
            "storage" => 20000000000
        ]);

        Spec::create([
            "uuid" => Str::uuid(),
            "cpus" => 1,
            "memory" => 3000000000,
            "storage" => 50000000000
        ]);

        Spec::create([
            "uuid" => Str::uuid(),
            "cpus" => 2,
            "memory" => 5000000000,
            "storage" => 40000000000
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specs');
    }
};
