<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workers', function (Blueprint $table) {

            // Remove columns
            $table->dropColumn(['email', 'phone']);

            // Add user_id after id
            $table->foreignId('user_id')
                  ->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {

            // Add back columns
            $table->string('email')->unique();
            $table->string('phone');

            // Remove foreign key & column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};