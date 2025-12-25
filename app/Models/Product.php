<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
         'slug',  
        'weight',
        'price',
        'description',
        'image',
        'is_active',
    ];

    // Product belongs to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function todayDeal()
{
    return $this->hasOne(TodayDeal::class);
}

}
