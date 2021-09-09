<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
//        'iso', 'name', 'nicename', 'phonecode',
        'active', 'is_supported'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
