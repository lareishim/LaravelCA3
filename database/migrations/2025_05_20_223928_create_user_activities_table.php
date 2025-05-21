<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->nullableMorphs('subject');
            $table->nullableMorphs('causer');
            $table->json('properties')->nullable();
            $table->string('event')->nullable(); // 🟢 REQUIRED
            $table->uuid('batch_uuid')->nullable(); // 🟢 REQUIRED
            $table->timestamps();

            $table->index('log_name');
            $table->index(['log_name', 'event']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
