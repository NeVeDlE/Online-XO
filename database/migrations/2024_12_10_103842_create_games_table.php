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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_one_id')->constrained()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('player_two_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnDelete();
            $table->integer('player_turn')->default(1);
            $table->foreignId('winner_id')->nullable()->constrained()->references('id')->on('users')->cascadeOnDelete();
            $table->json('state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game');
    }
};
