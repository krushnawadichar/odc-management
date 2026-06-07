<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('company_id');

            $table->string('work_title');

            $table->integer('no_of_workers')->nullable();

            $table->string('work_type')->nullable();

            $table->string('experience')->nullable();

            $table->decimal('salary_per_day', 10, 2)->nullable();

            $table->string('location')->nullable();

            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            $table->string('skills')->nullable();

            $table->longText('description')->nullable();

            $table->enum('status', ['Active', 'Inactive'])
                  ->default('Active');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')
                  ->references('id')
                  ->on('companies')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};