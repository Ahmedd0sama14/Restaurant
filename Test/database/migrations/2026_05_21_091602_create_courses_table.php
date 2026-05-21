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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2)->nullable();
            $table->integer('discount_type')->nullable();
            $table->decimal('price_after_discount', 8, 2)->nullable();
            $table->integer('duration');
            $table->integer('duration_type');
            $table->foreignId('course_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->restrictOnDelete();
            $table->string('image');
            $table->string('introduction_video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
