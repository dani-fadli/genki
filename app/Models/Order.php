<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'user_id',
        'type',
        'invoice_number',
        'prescription_image',
        'medicines',
        'total_payment',
        'status',
        'payment',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
    ];
}
