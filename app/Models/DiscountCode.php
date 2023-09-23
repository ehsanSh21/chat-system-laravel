<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $table = 'discount_codes';

    protected $fillable = [
        'code',
        'category_id',
        'discount_percent',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
