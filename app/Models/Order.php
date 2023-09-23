<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function itemsWithProfit()
    {

    }
//    public function profit()
//    {
//
//        $profits = $this->items->map(function ($q){
//            $withDiscount= $q->price;
//            $withoutDiscount= (($q->product->price)*($q->qty));
//            return ($withoutDiscount-$withDiscount);
//
//        });
//
//        return array_sum($profits->toArray()) ;
//    }
    public function getProfitAttribute()
    {

        $profits = $this->items->map(function ($q){
            $withDiscount= $q->price;
            $withoutDiscount= (($q->product->price)*($q->qty));
            return ($withoutDiscount-$withDiscount);

        });

        return array_sum($profits->toArray()) ;
    }


}
