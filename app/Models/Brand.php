<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'bg_image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function imageUrl(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'uploads/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }

    public function bgImageUrl(): ?string
    {
        if (!$this->bg_image) {
            return null;
        }

        if (str_starts_with($this->bg_image, 'uploads/')) {
            return asset($this->bg_image);
        }

        return asset('storage/' . $this->bg_image);
    }
}
