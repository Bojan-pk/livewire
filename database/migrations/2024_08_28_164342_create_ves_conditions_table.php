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
        Schema::create('ves_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('rb')->nullable();
            $table->string('old_ves')->nullable();
            $table->string('old_alternative')->nullable();
            $table->string('old_kind')->nullable();
            $table->text('old_condition')->nullable();
            $table->string('ves')->nullable();
            $table->text('reading')->nullable();
            $table->text('condition')->nullable();
            $table->text('alternative')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ves_conditions');
    }
};
