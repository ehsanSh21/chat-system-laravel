<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class UserController extends ApiBaseController
{

    public function __construct(private UserService $userService)
    {

    }


    /**
     * Display a listing of the resource.
     */




    public function index()
    {
        $users= User::all();

        return $this->successResponse(UserResource::collection($users));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request,User $user)
    {
//        dd('dfgdfg');
//        dd($userService);

         $user = $this->userService->store($user,$request->validated());
         $user->createToken('exam')->plainTextToken;
//        $user=User::create($request->validated());

        return $this->successResponse(UserResource::make($user),'کاربر با موفقیت اضافه شد', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return $this->successResponse(UserResource::make($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
//        dd($request->all());
        $user = $this->userService->update($user,$request->validated());
//        dd($user);
//        $user->update($request->validated());
        return $this->successResponse(UserResource::make($user),'کاربر ادیت شد',201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

            $this->userService->delete($user);

        return $this->successResponse(UserResource::make($user),'کاربر حذف شد',201);
    }
}
