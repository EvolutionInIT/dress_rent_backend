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
        if (!Schema::hasTable('booking_component'))
            Schema::create('booking_component', function (Blueprint $table) {
                $table->increments('booking_component_id');

                $table->unsignedInteger('booking_id');
                $table->foreign('booking_id')->references('booking_id')->on('booking');

                $table->unsignedInteger('component_id');
                $table->foreign('component_id')->references('component_id')->on('component');

                $table->unsignedTinyInteger('quantity')->default(1);

                $table->date('date_start')->default(null);
                $table->date('date_end')->default(null);

                $table->timestamps();
                $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_component');
    }
};
