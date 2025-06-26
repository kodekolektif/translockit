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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('lang')->default('en');
            $table->string('unique_id');
            $table->string('logo')->nullable()->comment('Product logo');
            $table->string('slug')->unique()->comment('Product slug for URL');
            $table->string('name')->comment('Product name');
            $table->text('description')->nullable()->comment('Product description');
            $table->boolean('is_active')->default(true)->comment('Is the product active?');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
