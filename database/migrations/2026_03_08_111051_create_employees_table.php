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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_image')->nullable();

            // Worker Details
            $table->json('skills')->nullable(); // Store skills as JSON
            $table->string('other_skill')->nullable(); // For custom skill input
            $table->date('registration_date');
            $table->decimal('salary_per_day', 10, 2)->nullable(); // Changed from salary
            $table->string('employment_type')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');

            // Education & Work
            $table->string('highest_education')->nullable();
            $table->string('work_duration')->nullable(); // How many time worker gives to company
            $table->string('document_name')->nullable(); // Document name field
            $table->string('document_path')->nullable(); // Document upload field

            // Address
            $table->text('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};