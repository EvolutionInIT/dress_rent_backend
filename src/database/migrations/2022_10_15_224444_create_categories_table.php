<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        if (!Schema::hasTable('category'))
            Schema::create('category', function (Blueprint $table) {
                $table->increments('category_id');
                $table->string('title', 255);
                $table->text('description', 5000);
                $table->timestamps();
                $table->softDeletes();
            });
    }

    public function down()
    {
        Schema::dropIfExists('category');
    }
};
