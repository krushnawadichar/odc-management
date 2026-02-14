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
        Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->string('company_name');
        $table->string('contact_person');
        $table->string('phone');
        $table->date('required_date');
        $table->integer('required_manpower');
        $table->enum('status',['open','fulfilled'])->default('open');
        $table->timestamps();

        $table->index(['required_date','status']);;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
