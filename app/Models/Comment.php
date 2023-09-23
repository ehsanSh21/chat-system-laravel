<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'published',
        'commentable_type',
        'commentable_id',
        'user_id',
        'parent_id',
        'depth',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function children()
    {
        return $this->replies()->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }

}
