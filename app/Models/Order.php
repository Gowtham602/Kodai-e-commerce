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
        'payment_method',
        'customer_name',
        'customer_phone',
        'customer_email',
        'shipping_address',
        'state',
        'pincode',
        'near_place',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

