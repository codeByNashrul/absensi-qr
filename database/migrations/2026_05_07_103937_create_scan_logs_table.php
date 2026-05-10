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
        Schema::create('scan_logs', function (Blueprint $table) {
    $table->id();

    $table->foreignId('student_id')->nullable()
          ->constrained('students')
          ->nullOnDelete();

    $table->foreignId('operator_id')->nullable()
          ->constrained('users')
          ->nullOnDelete();

    $table->foreignId('attendance_session_id')->nullable()
          ->constrained('attendance_sessions')
          ->nullOnDelete();

    $table->string('status');
    $table->text('message')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scan_logs');
    }
};
