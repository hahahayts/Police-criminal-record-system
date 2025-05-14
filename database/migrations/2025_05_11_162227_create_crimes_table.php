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
        Schema::create('crimes', function (Blueprint $table) {
            $table->id();

            // Foreign key to users (officer who created the report)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Crime details
            $table->string('case_number')->unique();
            $table->string('title'); // e.g., "Robbery at Market Street"
            $table->text('description')->nullable();
            $table->string('type'); // e.g., theft, assault, etc.
            $table->string('location');
            $table->dateTime('incident_date');
            $table->enum('status', ['open', 'under investigation', 'closed'])->default('open');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crimes');
    }
};

