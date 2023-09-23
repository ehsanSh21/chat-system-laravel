<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id',
        'order_id',
        'qty',
        'price',
        'isComplited',
        'useDiscount',
        ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

//    public function getTotalQtyAttribute()
//    {
//
//    }
}
