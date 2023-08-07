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
        if (!Schema::hasTable('color_translation'))
            Schema::create('color_translation', function (Blueprint $table) {
                $table->increments('color_translation_id');

                $table->unsignedInteger('color_id');
                $table->foreign('color_id')->references('color_id')->on('color');

                $table->char('language', 2);

                $table->string('title', 20);
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
        Schema::dropIfExists('color_translation');
    }
};
