<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user=auth()->user();

//        $allows=\Illuminate\Support\Facades\Gate::allows('update-post');
//
//        if ($allows){
//            return true;
//        }else{
//            return false;
//        }

        $items = User::with(['image'])->
        orderBy('id','desc')
            ->paginate(3)
            ;


        return view('admin.user.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        $items = User::with(['image'])->
        orderBy('id','desc')
            ->paginate(3)
        ;

        $data = $request->validated();
        User::create($data);
        return redirect(route('admin.user.index',compact('items')));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['products','image','blogs','comments']);

        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {

        $data =$request->validated();
        $user->update($data);
        return redirect(route('admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.user.index'));
    }
}

