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
        Schema::create('ves_second_signs', function (Blueprint $table) {
            $table->id();
            $table->string('sign');
            $table->string('description');
            $table->integer('order')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('regulation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ves_second_signs');
    }
};
