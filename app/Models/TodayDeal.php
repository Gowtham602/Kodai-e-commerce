<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayDeal extends Model
{
    use HasFactory;
     protected $fillable = [
        'product_id',
        'deal_price',
        'start_time',
        'end_time',
        'status'
    ];
     public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
