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
        Schema::create('crime_suspect', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('crime_id')->constrained()->onDelete('cascade');
            $table->foreignId('suspect_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crime_suspect');
    }
};
