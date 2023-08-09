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
        if (!Schema::hasTable('booking'))
            Schema::create('booking', function (Blueprint $table) {
                $table->increments('booking_id');

                $table->unsignedInteger('dress_id');
                $table->foreign('dress_id')->references('dress_id')->on('dress');

                $table->unsignedTinyInteger('quantity')->default(1);

                $table->date('date_start')->default(null);
                $table->date('date_end')->default(null);

                $table->string('status', 10)->default('new');

                $table->string('email');
                $table->string('phone_number', 12);

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
        Schema::dropIfExists('booking');
    }
};
