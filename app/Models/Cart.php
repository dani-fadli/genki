<?php

namespace App\Models;


use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Cart extends Model
{
    public $fillable = [
        'user_id',
        'medicine_id',
        'quantity',
    ];

    /**
     * One cart belongs to one user
     *
     * @return \MongoDB\Laravel\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One cart belongs to one medicine
     *
     * @return \MongoDB\Laravel\Relations\BelongsTo
     */
    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
