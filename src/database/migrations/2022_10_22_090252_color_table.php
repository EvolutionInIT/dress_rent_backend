<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('color'))
            Schema::create('color', function (Blueprint $table) {
                $table->increments('color_id');
                $table->string('color', 20);
                $table->softDeletes();
            });
    }

    public function down()
    {
        Schema::dropIfExists('color');
    }
};
