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
        Schema::create('resellers', function (Blueprint $table) {
            $table->id();
            $table->string('reseller_name')->nullable();
            $table->string('email')->nullable();
            $table->string('bkash')->nullable();
            $table->string('product_name')->nullable();
            $table->string('modified_price')->nullable();
            $table->string('modified_dcharge')->nullable();
            $table->string('quantity')->nullable();
            $table->string('modified_image')->nullable();
            $table->string('payment')->nullable();
            $table->string('reseller_id')->nullable();
            $table->string('product_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resellers');
    }
};
