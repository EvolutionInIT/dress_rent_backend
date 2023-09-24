<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('dress_size'))
            Schema::create('dress_size', function (Blueprint $table) {
                $table->increments('dress_size_id');

                $table->unsignedInteger('dress_id');
                $table->foreign('dress_id')->references('dress_id')->on('dress');

                $table->unsignedInteger('size_id');
                $table->foreign('size_id')->references('size_id')->on('size');

                $table->unsignedTinyInteger('quantity')->default(1);

                $table->timestamps();
                $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dress_size');
    }
};
