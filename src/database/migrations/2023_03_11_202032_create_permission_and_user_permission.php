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
        Schema::create('permission', function (Blueprint $table) {
            $table->increments('permission_id');
            $table->string('permission', 30);
            $table->timestamps();
        });

        Schema::create('user_permission', function (Blueprint $table) {
            $table->increments('user_permission_id');

            $table->unsignedInteger('permission_id');
            $table->foreign('permission_id')->references('permission_id')->on('permission');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('user');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permission');
        Schema::dropIfExists('permission');
    }
};
