<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moodboard extends Model
{
    protected $fillable = ['title', 'description', 'image', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

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
}
