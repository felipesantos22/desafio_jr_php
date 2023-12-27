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
        Schema::create('consultation', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->unsignedBigInteger('sick_id');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('sick_id')->references('id')->on('sick')->cascadeOnDelete();
            $table->foreign('doctor_id')->references('id')->on('doctor')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation');
    }
};
