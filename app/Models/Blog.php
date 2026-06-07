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
}
