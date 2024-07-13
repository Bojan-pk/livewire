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
        Schema::create('catalog_education', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_id'); // ili prilagodjeno ime polja
            $table->unsignedBigInteger('education_id'); // ili prilagodjeno ime polja
            $table->timestamps();

            // Dodavanje stranih ključeva
            $table->foreign('catalog_id')->references('id')->on('catalogs')->onDelete('cascade');
            $table->foreign('education_id')->references('id')->on('educations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_education');
    }
};
