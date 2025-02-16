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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->string("container", 511)->nullable();
            $table->string("name");
            $table->dateTime("start")->nullable();
            $table->dateTime("end")->nullable();
            $table->unsignedBigInteger("service_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("status_id");
            $table->timestamps();

            $table->foreign("service_id")->references("id")->on("services");
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("status_id")->references("id")->on("statuses");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
