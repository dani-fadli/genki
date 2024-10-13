<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Category extends Model
{
    public $fillable = [
        'name'
    ];

    /**
     * One category belongs to many medicines
     *
     * @return \MongoDB\Laravel\Relations\HasMany
     */
    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
