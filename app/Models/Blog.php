<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'category', 'featured_image', 'image_alt', 'content', 
        'meta_title', 'meta_description', 'meta_keywords', 'created_at', 'faq_title'
    ];

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_blog_category');
    }

    public function faqs()
    {
        return $this->hasMany(BlogFaq::class);
    }

    public function featuredImageUrl(): ?string
    {
        if (!$this->featured_image) {
            return null;
        }

        if (str_starts_with($this->featured_image, 'uploads/')) {
            return asset($this->featured_image);
        }

        return asset('storage/' . $this->featured_image);
    }
}
