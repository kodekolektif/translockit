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
        Schema::create('mobile_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('logo')->nullable();
            $table->string('lang')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('title')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_lists');
    }
};
