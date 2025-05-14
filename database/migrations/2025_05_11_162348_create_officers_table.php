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
        Schema::create('officers', function (Blueprint $table) {
            $table->id();

            // Officer details
            $table->string('badge_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('rank')->nullable(); // e.g., "Sergeant", "Chief Inspector"
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->boolean('active')->default(true); // currently assigned or not

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officers');
    }
};

