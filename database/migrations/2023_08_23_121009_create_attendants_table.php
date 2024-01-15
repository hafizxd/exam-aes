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
        Schema::create('attendants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('attendants');
    }
};
