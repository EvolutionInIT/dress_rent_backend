<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('booking_color_size'))
            Schema::create('booking_color_size', function (Blueprint $table) {
                $table->increments('booking_color_size_id');

                $table->unsignedInteger('booking_id');
                $table->foreign('booking_id')->references('booking_id')->on('booking');

                $table->unsignedInteger('color_id');
                $table->foreign('color_id')->references('color_id')->on('color');

                $table->unsignedInteger('size_id');
                $table->foreign('size_id')->references('size_id')->on('size');

                $table->unsignedTinyInteger('quantity')->default(1);
                $table->date('date')->default(null);

                $table->timestamps();
                $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_color_size');
    }
};
