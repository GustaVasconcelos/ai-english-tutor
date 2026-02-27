<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('learning_profiles', function (Blueprint $table) {
            $table->id();
            $table->boolean('correct_always')->default(true);
            $table->enum('explanation_language', ['pt', 'en'])->default('pt');
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_profiles');
    }
};
