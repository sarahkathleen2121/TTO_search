<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public const TYPE_VISUAL = 'visual';
    public const TYPE_USP = 'usp';
    public const TYPE_GALLERY = 'gallery';

    protected $fillable = [
        'product_id',
        'type',
        'path',
        'sort_order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function url(): string
    {
        if (str_starts_with($this->path, 'uploads/')) {
            return asset($this->path);
        }

        return asset('storage/' . ltrim($this->path, '/'));
    }
}
