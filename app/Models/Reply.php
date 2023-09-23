<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'replyable_type',
        'replyable_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function replyable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->morphMany(Reply::class, 'replyable');
    }



}
