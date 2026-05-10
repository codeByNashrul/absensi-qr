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
        Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('school_class_id')->constrained('school_classes')->cascadeOnDelete();
    $table->string('nis')->unique();
    $table->string('name');
    $table->enum('gender', ['male', 'female'])->nullable();
    $table->string('photo')->nullable();
    $table->string('qr_token')->unique();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
