<?php
// database/migrations/2024_01_01_000000_create_companies_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            
            // Company Basic Details
            $table->string('company_name');
            $table->string('registration_number')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->year('founded_year')->nullable();
            
            // Contact Person Details
            $table->string('contact_person_name');
            $table->string('contact_person_designation')->nullable();
            $table->string('contact_person_email');
            $table->string('contact_person_phone');
            
            // Address Information
            $table->text('address');
            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->string('postal_code');
            
            // Documents
            $table->string('document_name')->nullable();
            $table->string('document')->nullable();
            
            // Status
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};