<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('team')->nullable();
            $table->string('position')->nullable();
            $table->string('image')->nullable(); // Player photo
            $table->string('highlight_url')->nullable(); // YouTube highlights
            $table->string('afrobeats_track')->nullable(); // YouTube/Spotify track ID
            $table->integer('points_per_game')->nullable();
            $table->integer('assists_per_game')->nullable();
            $table->integer('rebounds_per_game')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
