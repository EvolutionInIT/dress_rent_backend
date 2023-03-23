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
        if (!Schema::hasTable('component_translation'))
            Schema::create('component_translation', function (Blueprint $table) {
                $table->increments('component_translation_id');

                $table->unsignedInteger('component_id');
                $table->foreign('component_id')->references('component_id')->on('component');

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
        Schema::dropIfExists('component_translation');
    }
};
