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
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function medicines()
    {
        return $this->belongsTomany(Medicine::class, 'medicines', '_id', 'medicines.medicine_id');
    }
}
