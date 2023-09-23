<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'chat_partner',
        'reply_parent',
        'pin',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function chatPartner()
    {
        return $this->belongsTo(User::class,'chat_partner','id');
    }

    public function reply()
    {
        return $this->belongsTo(Message::class,'reply_parent');

//        return Str::limit($this->body, 2 );
    }

//    public function repBody()
//    {
//        $body = $this->reply()->where('user_id',auth()->user()->id)->get();
//        dd($body);
//    }

//    public function messageNotRead(User $user)
//    {
//
//        return Message::
//        where('chat_partner',auth()->user()->id)
//            ->where('user_id',$this->id)
//            ->where('chat_partner_seen',false)->count();
//
//    }

}
