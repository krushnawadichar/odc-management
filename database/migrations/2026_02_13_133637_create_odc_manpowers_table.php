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
        Schema::create('odc_manpowers', function (Blueprint $table) {
           $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('skills')->nullable();
            $table->date('available_date');
            $table->enum('status', ['available','booked'])->default('available');
            $table->timestamps();

            $table->index(['available_date','status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odc_manpowers');
    }
};
