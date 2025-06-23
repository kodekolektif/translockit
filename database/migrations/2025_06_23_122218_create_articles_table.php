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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('lang')->default('en'); // Default language for the article
            $table->string('unique_id');
            $table->string('slug');
            $table->string('thumbnail')->nullable(); // Optional image URL for the article
            $table->string('title');
            $table->text('content');
            $table->boolean('is_published')->default(false); // Indicates if the article is published
            $table->string('category')->nullable(); // Optional category for the article
            $table->json('tags')->nullable(); // Optional tags for the article, stored as JSON
            $table->integer('views')->default(0); // Number of views for the article
            $table->integer('likes')->default(0); // Number of likes for the article
            $table->timestamp('published_at')->nullable(); // For published articles
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
