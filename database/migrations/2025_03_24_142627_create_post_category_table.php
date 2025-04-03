<?php

use App\Models\Category;
use App\Models\Post;
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

        // cascadeOnDelete ensures that when a post or category is deleted, the related pivot entry is also removed.
        // If all posts or categories are deleted, the relationships are cleaned up automatically,
        // but the remaining posts or categories themselves still exist.
        // Note: this only works correctly if both foreign keys have cascadeOnDelete() applied.
        Schema::create('post_category', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            // add unique constraint to prevent duplicate relationships
            $table->unique(['post_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_category');
    }
};
