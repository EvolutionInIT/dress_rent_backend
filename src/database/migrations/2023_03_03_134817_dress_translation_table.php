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
        if (!Schema::hasTable('dress_translation'))
            Schema::create('dress_translation', function (Blueprint $table) {
                $table->increments('dress_translation_id');

                $table->unsignedInteger('dress_id');
                $table->foreign('dress_id')->references('dress_id')->on('dress');

                $table->char('language', 2);

                $table->string('title', 255);
                $table->text('description', 5000);

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
        Schema::dropIfExists('dress_translation');
    }
};
