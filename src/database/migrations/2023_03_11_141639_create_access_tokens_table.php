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
        Schema::create('user_access_tokens', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->unsignedInteger('user_id')->index()->nullable();
            $table->boolean('revoked')->default(0);
            $table->dateTime('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_access_tokens');
    }
};
