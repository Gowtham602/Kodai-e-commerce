<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'total',
        'status',
        'payment_status',
        'payment_method',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

