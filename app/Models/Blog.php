<?php

namespace App\Models;

use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Blog extends Model
{
    use HasFactory,HasLike;

    protected $fillable = [
        'category_id',
        'title',
        'body',
        'description',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }



}
