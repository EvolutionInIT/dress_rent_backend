<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        if (!Schema::hasTable('user'))
            Schema::create('user', function (Blueprint $table) {
                $table->increments('user_id');
                $table->string('firstname')->default('');
                $table->string('lastname')->default('');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
