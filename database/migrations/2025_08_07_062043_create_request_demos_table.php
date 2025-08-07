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
        Schema::create('request_demos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('school_name', 255);
            $table->string('email', 255)->unique();
            $table->string('country_code', 5)->default('+977');
            $table->string('phone', 10)->unique();
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_demos');
    }
};
