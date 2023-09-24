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
        if (!Schema::hasTable('dress_color'))
            Schema::create('dress_color', function (Blueprint $table) {
                $table->increments('dress_color_id');

                $table->unsignedInteger('dress_id');
                $table->foreign('dress_id')->references('dress_id')->on('dress');

                $table->unsignedInteger('color_id');
                $table->foreign('color_id')->references('color_id')->on('color');

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
        Schema::dropIfExists('dress_color');
    }
};
