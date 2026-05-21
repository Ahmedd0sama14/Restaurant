<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Illuminate\Support\enum_value;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soldiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rank')->default('جندى');
            $table->string('military_number')->unique();
            $table->string('national_id')->unique()->nullable();
            $table->string('transfer_order')->nullable();
            $table->string('triple_1')->nullable();
            $table->string('triple_2')->nullable();
            $table->string('triple_3')->nullable();

            $table->date('recruitment_date')->nullable();
            $table->date('release_date')->nullable();

            $table->string('center')->nullable();
            $table->string('governorate')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('boot_size')->nullable();
            $table->string('overall_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soldiers');
    }
};
