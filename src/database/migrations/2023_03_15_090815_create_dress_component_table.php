<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('dress_component'))
            Schema::create('dress_component', function (Blueprint $table) {
                $table->increments('dress_component_id');

                $table->unsignedInteger('dress_id');
                $table->foreign('dress_id')->references('dress_id')->on('dress');

                $table->unsignedInteger('component_id')->nullable();
                $table->foreign('component_id')->references('component_id')->on('component');

                $table->softDeletes();

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dress_component');
    }
};
