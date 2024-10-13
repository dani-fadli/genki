<?php

namespace App\Models;


use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Medicine extends Model
{
    public $fillable = [
        'name',
        'category_id',
        'detail',
        'price',
        'stock',
        'rating',
    ];

    /**
     * One medicine belongs to many categories
     *
     * @return \MongoDB\Laravel\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
