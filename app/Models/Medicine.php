<?php

namespace App\Models;


use MongoDB\Laravel\Eloquent\Model;

class Medicine extends Model
{
    public $fillable = [
        'name',
        'detail',
        'price',
        'image_urls'
    ];
}
