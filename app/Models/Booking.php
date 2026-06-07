<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'staff_member',
        'date',
        'time',
        'name',
        'email',
        'phone',
        'company_name',
    ];
}
