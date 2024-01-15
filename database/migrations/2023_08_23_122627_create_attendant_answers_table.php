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
        Schema::create('attendant_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('test_question_id')->constrained()->cascadeOnDelete();
            $table->text('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendant_answers');
    }
};
