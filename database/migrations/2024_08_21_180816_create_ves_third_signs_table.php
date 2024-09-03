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
        Schema::create('ves_third_signs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ves_second_sign_id')
              ->constrained('ves_second_signs')
              ->onDelete('cascade');
            $table->string('sign');
            $table->string('description');
            $table->integer('order')->nullable();
            $table->unsignedBigInteger('regulation_id');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ves_third_signs');
    }
};
