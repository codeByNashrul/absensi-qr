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
        Schema::create('attendances', function (Blueprint $table) {
    $table->id();

    $table->foreignId('attendance_session_id')
          ->constrained('attendance_sessions')
          ->cascadeOnDelete();

    $table->foreignId('student_id')
          ->constrained('students')
          ->cascadeOnDelete();

    $table->enum('status', [
        'hadir',
        'izin',
        'sakit',
        'alfa'
    ])->default('hadir');

    $table->dateTime('scan_time')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
