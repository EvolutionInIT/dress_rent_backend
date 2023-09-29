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
        Schema::create('dress_price', function (Blueprint $table) {
            $table->increments('dress_price_id');

            $table->unsignedInteger('dress_id');
            $table->foreign('dress_id')->references('dress_id')->on('dress');

            $table->char('code', 3);

            $table->integer('price');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dress_price');
    }
};
