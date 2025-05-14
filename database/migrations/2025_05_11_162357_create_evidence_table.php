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
        Schema::create('evidence', function (Blueprint $table) {
            $table->id();

            // Link to the crime
            $table->foreignId('crime_id')->constrained()->onDelete('cascade');

            // Evidence details
            $table->string('type'); // e.g., "Weapon", "CCTV Footage", "Document"
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable(); // optional if there's an uploaded file/image
            $table->date('date_collected')->nullable();
            $table->string('collected_by')->nullable(); // Officer name or ID

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence');
    }
};
