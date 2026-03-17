<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {

            //  Add user_id after id
            $table->unsignedBigInteger('user_id')
                  ->after('id')
                  ->nullable();

            // (Optional but recommended) Foreign key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            //  Remove unwanted columns
            $table->dropColumn(['email', 'phone', 'company_name']);
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {

            //  Drop foreign key first
            $table->dropForeign(['user_id']);

            //  Drop column
            $table->dropColumn('user_id');

            //  Restore removed columns
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('company_name');
        });
    }
};