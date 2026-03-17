<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('role_id')
                  ->after('id')
                  ->nullable();

            $table->string('phone', 20)
                  ->nullable()
                  ->after('email');

            $table->enum('status', ['Active', 'Inactive', 'Block'])
                  ->default('Active')
                  ->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn(['role_id', 'phone', 'status']);
        });
    }
};