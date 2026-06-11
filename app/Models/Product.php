<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'sku', 'description', 'price', 'availability',
        'thumbnail', 'external_image_path',
        'is_featured', 'brand_id', 'product_type_id'
    ];

    public function referenceImageUrl(): ?string
    {
        if ($this->thumbnail) {
            // New path: uploads/products/filename.ext (directly in public/)
            if (str_starts_with($this->thumbnail, 'uploads/')) {
                return asset($this->thumbnail);
            }
            // Old path: products/filename.ext (via storage symlink)
            return asset('storage/'.$this->thumbnail);
        }

        $path = trim((string) $this->external_image_path);
        if ($path === '' || $path === 'no_selection') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $base = rtrim(config('ai-search.media_base_url', config('app.url')), '/');

        return $base.'/'.ltrim($path, '/');
    }

    public function hasReferenceImage(): bool
    {
        return $this->hasIndexableImage();
    }

    /** Image can be embedded only when the AI service can fetch the URL. */
    public function hasIndexableImage(): bool
    {
        if ($this->thumbnail) {
            return true;
        }

        $path = trim((string) $this->external_image_path);
        if ($path === '' || $path === 'no_selection') {
            return false;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return true;
        }

        if (! str_starts_with($path, '/')) {
            return false;
        }

        $base = rtrim(config('ai-search.media_base_url', config('app.url')), '/');
        $host = parse_url($base, PHP_URL_HOST);

        return ! in_array($host, ['127.0.0.1', 'localhost', '::1'], true);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function industries()
    {
        return $this->belongsToMany(Industry::class);
    }

    public function spaces()
    {
        return $this->belongsToMany(Space::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function visualImages()
    {
        return $this->hasMany(ProductImage::class)
            ->where('type', ProductImage::TYPE_VISUAL)
            ->orderBy('sort_order');
    }

    public function uspImages()
    {
        return $this->hasMany(ProductImage::class)
            ->where('type', ProductImage::TYPE_USP)
            ->orderBy('sort_order');
    }

    public function galleryImages()
    {
        return $this->hasMany(ProductImage::class)
            ->where('type', ProductImage::TYPE_GALLERY)
            ->orderBy('sort_order');
    }
}
