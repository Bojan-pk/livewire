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
        Schema::create('rulebooks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('regulation_id');
           // $table->unsignedBigInteger('rulebooks_table_id');
           // $table->foreignId('rulebooks_table_id')->constrained('rulebook_tables')->onDelete('cascade');
            $table->foreignId('rulebooks_table_id')
              ->constrained('rulebooks_tables')
              ->onDelete('cascade');
            $table->string('rb');
            $table->string('fm');
            $table->string('fc_sso');
            $table->string('pg_bb');
            $table->string('note'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rulebooks');
    }
};
