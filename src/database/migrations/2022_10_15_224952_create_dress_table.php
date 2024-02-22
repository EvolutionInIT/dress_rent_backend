<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (!Schema::hasTable('dress'))
            Schema::create('dress', function (Blueprint $table) {
                $table->increments('dress_id');
                $table->unsignedTinyInteger('quantity')->default(1);

                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('user_id')->on('user');

                //$table->unsignedInteger('price')->default(0);

                $table->timestamps();
                $table->softDeletes();
            });

        Schema::table('category', function (Blueprint $table) {
            $table->unsignedInteger('dress_id')->nullable();
            $table->foreign('dress_id')->references('dress_id')->on('dress');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dress');
    }
};
