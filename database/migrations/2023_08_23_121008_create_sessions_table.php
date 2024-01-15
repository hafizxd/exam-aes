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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('code_encrypted');
            $table->foreignId('test_id')->constrained()->cascadeOnDelete();
            $table->string('class');
            $table->string('teacher');
            $table->string('date_start');
            $table->string('time_start');
            $table->string('time_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
