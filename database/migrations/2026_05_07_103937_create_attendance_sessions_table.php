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
        Schema::create('attendance_sessions', function (Blueprint $table) {
    $table->id();

    $table->foreignId('activity_id')
          ->constrained('activities')
          ->cascadeOnDelete();

    $table->foreignId('operator_id')
          ->constrained('users')
          ->cascadeOnDelete();

    $table->string('title');

    $table->date('date');

    $table->time('start_time');
    $table->time('end_time');

    $table->boolean('is_active')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_sessions');
    }
};
