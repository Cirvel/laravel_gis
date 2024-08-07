<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public $fillable = [
        'name',
        'image',
        'description',
        'menu',
        'address',
        'latitude',
        'longitude',
        'embed'
    ];

    use HasFactory;
}
