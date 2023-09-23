<?php

namespace App\Http\Services\User;

use App\Http\Services\ApiBaseService;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService extends ApiBaseService
{



    public function __construct()
    {

    }

//    public function store(array $payload): User
//    {
//        return  User::create($payload);
//    }

//    public function update(User $user,array $payload): User
//    {
////            dd([$user->phone,
////                $payload,
////            ]);
//        $user->update($payload);
//        return $user;
//    }


//    public function delete(User $user)
//    {
//        return $user->delete();
//    }



    public function buyPro(Product $product,User $user)
    {

    }

}
