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
        if (!Schema::hasTable('dress'))
            Schema::create('dress', function (Blueprint $table) {
                $table->increments('dress_id');
                $table->string('title', 255);
                $table->text('description', 5000)->default('reed dress');

                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');

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
        Schema::dropIfExists('dress');
    }
};
