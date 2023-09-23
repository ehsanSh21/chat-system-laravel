<?php

namespace App\Traits;

use App\Models\Like;

trait HasLike
{
    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }

    public function like($user_id)
    {
        $like =$this->likes()->where('user_id',$user_id)->first();
        if($like){
            return $like->delete();
        }
        return $this->likes()->create(['user_id' => $user_id]);
    }



}
