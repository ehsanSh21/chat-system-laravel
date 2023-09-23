<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Like;


class LikeController extends Controller
{

    public function like($type,$id)
    {
//    dd([
//       $type,
//       $model,
//    ]);


        switch ($type) {
            case 'blog':
                $blog = Blog::where('id',$id)->first();
                $blog->like(auth()->user()->id);
                break;
            case 'product':
                $product = Product::where('id',$id)->first();
                $product->like(auth()->user()->id);
                break;
            case 'user':
                $user = User::where('id',$id)->first();
                $user->like(auth()->user()->id);
                break;
        }

        return redirect()->back();



//        if ($type=='blog'){
//
//            if (!Like::where('user_id',auth()->user()->id)
//                ->where('likeable_id', $id)
//                ->first()) {
//                if (Like::where('likeable_id', $id)->first()) {
//
//                    $like = Like::where('likeable_id', $id)
//                        ->max('updated_at');
//                    $likeRow = Like::where('updated_at', $like)->first();
//                    $likeRowCont = $likeRow->count;
//
//                    Like::create([
//                        'count' => $likeRowCont + 1,
//                        'likeable_type' => 'App\Models\Blog',
//                        'likeable_id' => $id,
//                        'user_id' => auth()->user()->id,
//                    ]);
//                    return redirect()->back();
//
//
//                } else {
//
//                    Like::create([
//                        'count' => 1,
//                        'likeable_type' => 'App\Models\Blog',
//                        'likeable_id' => $id,
//                        'user_id' => auth()->user()->id,
//                    ]);
//
//                    return redirect()->back();
//                }
//            }
//            else{
//                return redirect()->back();
//            }
//
//        }else{
//            dd('bye');
//        }


    }
}
