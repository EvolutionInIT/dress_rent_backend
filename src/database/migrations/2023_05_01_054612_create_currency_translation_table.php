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
        Schema::create('currency_translation', function (Blueprint $table) {
            $table->increments('currency_translation_id');

            $table->unsignedInteger('currency_id');
            $table->foreign('currency_id')->references('currency_id')->on('currency');

            $table->char('language', 2);
            $table->string('title');

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_translation');
    }
};
