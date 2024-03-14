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
        Schema::table('dress', function (Blueprint $table) {
            $table->boolean('home')->default(false);
            $table->boolean('top')->default(false);
            $table->boolean('wide')->default(false);
            $table->unsignedTinyInteger('period')->default(1);
            $table->unsignedSmallInteger('order')->default(0);

            $table->index('home');
            $table->index('top');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dress', function (Blueprint $table) {
            $table->dropIndex(['home']);
            $table->dropIndex(['top']);
            $table->dropIndex(['order']);

            $table->dropColumn('home');
            $table->dropColumn('top');
            $table->dropColumn('wide');
            $table->dropColumn('period');
            $table->dropColumn('order');
        });
    }
};
