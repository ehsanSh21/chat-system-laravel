<?php

namespace App\Http\Controllers;

use App\Http\Resources\LikeResource;
use App\Models\Product;
use App\Models\User;

class TestController extends Controller
{
    public function index()
    {

//        $user=User::find(1);
//        $likes=$user->myLikes;
//        return LikeResource::collection($likes);

//        $product=Product::with('user:id,name as user_name')
//        ->take(2)
////            ->get();
//        $user=User::where('id',31)
//            ->with('orders')
//            ->get();

//        $products=Product::with([
//            'orderItems',
//            'orderItems.order'
//        ])
//            ->where(function ())
//            ->get();
//        $user->with('orders')->get();

        return response()->json($products);

    }
}
