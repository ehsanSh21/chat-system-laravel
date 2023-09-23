<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'count',
        'likeable_type',
        'likeable_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function likeable()
    {
        return $this->morphTo();
    }

//    public function title()
//    {
//        switch ($this->likeable_type){
//            case Product::class:
//                return $this->likeable->title;
//            case Blog::class:
//                return $this->likeable->title;
//            case User::class:
//                return $this->likeable->name;
//        }
//    }

    public function title($val):Attribute
    {
//        dd($val);
        return Attribute::make(
            get: fn (Model $value) =>  dd($value),
            set: fn (Model $value) => strtolower($value),
        );
    }

}
