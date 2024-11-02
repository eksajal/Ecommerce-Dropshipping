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
        // Modify the usertype column to remove the default value
        Schema::table('users', function (Blueprint $table) {
            $table->string('usertype')->default(null)->change(); // Set default to null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // If needed, revert the default value back to 'user'
         Schema::table('users', function (Blueprint $table) {
            $table->string('usertype')->default('user')->change();
        });
    }
};
