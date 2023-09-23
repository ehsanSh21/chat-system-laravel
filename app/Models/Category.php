<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function discountCodes()
    {
        return $this->hasMany(DiscountCode::class);
    }


}
