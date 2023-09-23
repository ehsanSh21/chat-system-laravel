<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;


class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable,HasLike,HasRoles;




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'last_name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function myLikes()
    {
        return $this->hasMany(Like::class);
    }

//    public function roles()
//    {
//        return $this->belongsToMany(Role::class);
//    }

    public function hasRole(string $name):bool
    {
        return $this->roles()->where('name',$name)->exists();
    }
    public function hasPermission(string $name):bool
    {
        $permission= Permission::where('name','=',$name)->first();
        if (!$permission){
            return false;
        }else{
            foreach ($permission->roles()->pluck('name') as $item){
                if($this->hasRole($item)){
                    return true;
                }else{
                    return false;
                }

            }
        }
    }


    public function myMessages()
    {
        return $this->hasMany(Message::class);
    }

    public function myInbox()
    {
        return $this->hasMany(Message::class,'chat_partner');
    }

    public function notSeenMessages($user_id)
    {
        return $this->myInbox()
            ->where('user_id',$user_id)
            ->whereNotNull('body')
            ->
        where('chat_partner_seen',false)->count();
    }

    public function messageNotRead()
    {

        return Message::
            where('chat_partner',auth()->user()->id)
            ->where('user_id',$this->id)
            ->whereNotNull('body')
            ->where('chat_partner_seen',false)->get();

    }
    public function lastMessage()
    {

        return Message::
        where('chat_partner',auth()->user()->id)
            ->where('user_id',$this->id)
            ->whereNotNull('body')
            ->orWhere(function ($q){
                $q->where('user_id',auth()->user()->id);
                $q->where('chat_partner',$this->id);
                $q->whereNotNull('body');
            })
            ->orderBy('created_at','desc')
            ->pluck('created_at')
            ->first();

    }

    public function pin()
    {

        return Message::
        where('chat_partner',$this->id)
            ->where('user_id',auth()->user()->id)
//            ->orderBy('updated_at','desc')
            ->where('pin',true)
            ->pluck('updated_at')
            ->first();

    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
