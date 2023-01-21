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
        if (!Schema::hasTable('photo'))
            Schema::create('photo', function (Blueprint $table) {
                $table->increments('photo_id');

                $table->unsignedInteger('dress_id')->nullable();
                $table->foreign('dress_id')->references('dress_id')->on('dress');

                $table->string('image', 100);
                $table->string('image_small', 100); //32 + 1 + 3-4

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
        Schema::dropIfExists('photo');
    }
};
