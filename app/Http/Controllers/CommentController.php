<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function approve($id){
        $comment =Comment::find($id);
//        dd($comment->commentable_id);
        $comment->update([
            'published'=>'1'
        ]);

//        $myComment=Comment::with('user')->where('id',$id)->get();
//        dd($myComment);
        return redirect(route('admin.blog.show',$comment->commentable_id));
    }


    public function store(Request $request,Blog $blog)
    {

        $data =$blog->comments()->create([
           'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        $blog->load(['image','comments','user']);
        $comments = Comment::whereHasMorph(
            'commentable',
            [Blog::class, Product::class],
            function (Builder $query) {
                $query->where('commentable_type', 'like', '%Blog')
                    ->where('published','1')
                ;
            }
        )->where('commentable_id',$blog->id)
            ->get();
        return redirect()->back();
    }

    public function reply(Request $request,$id,$depth)
    {
//        dd([
//           $request->all(),
//           $id,
//            $depth,
//        ]);
//        dd([
//            $type,
//            $id
//        ]);


        $data =Comment::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
            'published'=>true,
            'commentable_type'=>'App\Models\Blog',
            'commentable_id'=>$id,
            'parent_id'=>$id,
            'depth'=>$depth,


        ]);

//        dd([
//           $data
//        ]);

        return redirect()->back();

    }






}
