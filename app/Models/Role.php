<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsToMany;

class Role extends Model
{
    public $fillable = [
        'name',
        'permissions'
    ];

    /**
     * One role belongs to many users
     *
     * @return \MongoDB\Laravel\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
