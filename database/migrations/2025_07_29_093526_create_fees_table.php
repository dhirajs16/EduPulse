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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->year('year');
            $table->unsignedTinyInteger('month')->check('month >= 1 AND month <= 12');

            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');

            $table->unique(['name', 'grade_id', 'year', 'month'], 'unique_fee_per_grade_per_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
