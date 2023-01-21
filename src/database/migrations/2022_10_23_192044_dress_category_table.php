<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        if (!Schema::hasTable('dress_category'))
            Schema::create('dress_category', function (Blueprint $table) {
                $table->increments('dress_category_id');

                $table->unsignedInteger('dress_id');
                $table->foreign('dress_id')->references('dress_id')->on('dress');

                $table->unsignedInteger('category_id');
                $table->foreign('category_id')->references('category_id')->on('category');

                $table->softDeletes();
                //$table->timestamps();
            });
    }

    public function down()
    {
        //
    }
};
