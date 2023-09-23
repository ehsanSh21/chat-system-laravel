<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];



    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
