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
                $table->string('title', 255);
                $table->text('description', 5000);
                $table->integer('quantity')->unsigned();

                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('user_id')->on('user');

                $table->timestamps();
                $table->softDeletes();
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('dress');
    }
};
