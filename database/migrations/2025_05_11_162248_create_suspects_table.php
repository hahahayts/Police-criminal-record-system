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
        Schema::create('suspects', function (Blueprint $table) {
            $table->id();

            // Relationship to a crime
            $table->foreignId('crime_id')->constrained()->onDelete('cascade');

            // Suspect details
            $table->string('first_name');
            $table->string('last_name');
            $table->string('alias')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable(); // physical appearance, notes
            $table->enum('status', ['at large', 'in custody', 'released'])->default('at large');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspects');
    }
};

