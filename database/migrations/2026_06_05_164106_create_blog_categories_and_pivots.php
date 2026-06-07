<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create blog_categories table
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 2. Create blog_blog_category pivot table
        Schema::create('blog_blog_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->cascadeOnDelete();
            $table->foreignId('blog_category_id')->constrained('blog_categories')->cascadeOnDelete();
            $table->timestamps();
        });

        // 3. Make the existing category column nullable on blogs table (if it exists)
        if (Schema::hasColumn('blogs', 'category')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->string('category')->nullable()->change();
            });
        }

        // 4. Seed default categories (Blog, News, Guides)
        $defaultCategories = ['Blog', 'News', 'Guides'];
        $categoryIds = [];
        foreach ($defaultCategories as $catName) {
            $slug = Str::slug($catName);
            $catId = DB::table('blog_categories')->insertGetId([
                'name' => $catName,
                'slug' => $slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $categoryIds[$catName] = $catId;
        }

        // 5. Migrate existing blogs category strings to the new pivot table
        if (Schema::hasTable('blogs')) {
            $blogs = DB::table('blogs')->get();
            foreach ($blogs as $blog) {
                if (!empty($blog->category)) {
                    $catName = trim($blog->category);
                    
                    // If it is not one of the default categories, insert it dynamically
                    if (!isset($categoryIds[$catName])) {
                        $slug = Str::slug($catName);
                        // Avoid slug conflicts
                        $count = DB::table('blog_categories')->where('slug', $slug)->count();
                        if ($count > 0) {
                            $slug = $slug . '-' . time();
                        }
                        
                        $catId = DB::table('blog_categories')->insertGetId([
                            'name' => $catName,
                            'slug' => $slug,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $categoryIds[$catName] = $catId;
                    }

                    // Link the blog to the category in the pivot table
                    DB::table('blog_blog_category')->insert([
                        'blog_id' => $blog->id,
                        'blog_category_id' => $categoryIds[$catName],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_blog_category');
        Schema::dropIfExists('blog_categories');

        // Restore category column constraints on blogs if needed
        if (Schema::hasColumn('blogs', 'category')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->string('category')->nullable(false)->change();
            });
        }
    }
};
