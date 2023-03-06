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
        if (!Schema::hasTable('category_translation'))
            Schema::create('category_translation', function (Blueprint $table) {
                $table->increments('category_translation_id');

                $table->unsignedInteger('category_id');
                $table->foreign('category_id')->references('category_id')->on('category')->onDelete('cascade');

                $table->char('language', 2); // Нужно сделать index а не char

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
        Schema::dropIfExists('category_translation');
    }
};
