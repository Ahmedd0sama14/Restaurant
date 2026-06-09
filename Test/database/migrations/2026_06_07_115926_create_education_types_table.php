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
        Schema::create('education_types', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(0);
            $table->timestamps();
        });
        Schema::create('education_types_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_type_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->unique(['education_type_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_types');
        Schema::dropIfExists('education_types_translations');
    }
};
