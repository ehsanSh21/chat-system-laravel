<?php

namespace App\Models;

use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory,HasLike;

    protected $fillable = [
        'title',
        'body',
        'price',
        'description',
        'brand_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function isOrderd()
    {
        return Product::where('id',$this->id)->whereHas('orderItems',function ($q){
            $q->where('isComplited',false);
            $q->whereHas('order',function ($q){
                $q->where('user_id',auth()->user()->id);
            });
        })->exists();
    }

}
