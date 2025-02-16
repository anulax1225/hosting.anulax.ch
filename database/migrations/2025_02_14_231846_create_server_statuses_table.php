<?php

use App\Models\Status;
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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("message");
            $table->timestamps();
        });

        Status::create([
            "title" => "Running",
            "message" => "",
        ]);

        Status::create([
            "title" => "Pending",
            "message" => "",
        ]);

        Status::create([
            "title" => "Offline",
            "message" => "",
        ]);

        Status::create([
            "title" => "Failed",
            "message" => "",
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_statuses');
    }
};
