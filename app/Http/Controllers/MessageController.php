<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $users=User::where('isAdmin','=',1)
            ->where('id','!=', auth()->user()->id)
            ->get();

        $admins= $users->transform(function ($user) {
            $user->messages =$user->messageNotRead()->count();
           $user->last_message=$user->lastMessage();
           $user->pin=$user->pin();
            return $user;
        })->sortByDesc(function ($user) {
            return $user->pin ? 1 : 0;
        })->sortByDesc('last_message')
            ->sortByDesc('pin')
            ;
        return view('admin.user.chat.index',compact(['admins']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(User $user)
    {

        $notSeen=Message::where('user_id',$user->id)
            ->where('chat_partner',auth()->user()->id)
            ->where('chat_partner_seen',false)
//            ->with('reply')
            ->count();


        $myQ=Message::where('user_id',$user->id)
            ->where('chat_partner',auth()->user()->id)
            ->latest('created_at')
            ->pluck('id')
        ;

        DB::table('messages')
            ->whereIn('id',$myQ)
            ->update(array(
                "messages.chat_partner_seen" => true,
            ));

        $messages=Message::where(function ($q) use ($user) {
                $q->where('user_id',auth()->user()->id)
                    ->where('chat_partner',$user->id)
                    ->whereNotNull('body')
                ;
            })->orWhere(function($q) use ($user){
                $q->where('chat_partner',auth()->user()->id)
                    ->where('user_id',$user->id)
                    ->whereNotNull('body')
                ;
            })
            ->orderBy('id')
            ->get();

        return view('admin.user.chat.messages',compact(['user','messages']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,User $user)
    {

        Message::create([
            'body'=>$request->body,
            'user_id'=>auth()->user()->id,
            'chat_partner'=>$user->id,
        ]);

        return redirect()->back();
    }

    public function reply(User $user,Message $message,Request $request)
    {
        Message::create([
            'body'=>$request->body,
            'user_id'=>auth()->user()->id,
            'chat_partner'=>$user->id,
            'reply_parent'=>$message->id,
        ]);

        return redirect()->back();
    }

    public function pin(User $user)
    {
        if ($user->pin() != null) {
            $myRow=Message::where('user_id', auth()->user()->id)
                ->where('chat_partner', $user->id)
                ->where('pin', true)
                ->update(['pin' => 0]);

        } else {

        $dfg = Message::where('user_id', auth()->user()->id)
            ->where('chat_partner', $user->id)
            ->latest()
            ->first();

        if ($dfg) {
            Message::where('user_id', auth()->user()->id)
                ->where('chat_partner', $user->id)
                ->where('pin', true)
                ->whereNot('id', $dfg->id)
                ->update(['pin' => 0]);

            if ($dfg->pin == false) {
                $dfg->pin = 1;
                $dfg->save();
            } else {
                $dfg->pin = 1;
                $dfg->updated_at = Carbon::now();
                $dfg->save();
            }
        }else{
            Message::create([
               'user_id' => auth()->user()->id,
               'chat_partner' => $user->id,
               'pin'=>1,
            ]);
        }
    }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */

}
