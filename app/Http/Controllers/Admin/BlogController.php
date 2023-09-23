<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Product;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Blog::with(['image','comments'])->
        orderBy('id','desc')
            ->paginate(8);

        return view('admin.blog.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();

        return view('admin.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {


        $data =$request->validated();
        $data['user_id']=auth()->user()->id;
//        $data['category_id']=5;
//        $data['user_id']=auth()->user()->id;
//        dd($data);


        Blog::create($data);
        return redirect(route('admin.blog.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {

//        if($blog->likes->pluck('user_id')->contains(auth()->user()->id)){
//            dd('true');
//        }else{
//            dd('false');
//        }
        $blog->load(['image','user','likes']);
//        $comments = Comment::whereHasMorph(
//            'commentable',
//            [Blog::class, Product::class],
//            function (Builder $query) {
//                $query->where('commentable_type', 'like', '%Blog')
//                ->where('published','1')
//                ;
//            }
//        )->where('commentable_id',$blog->id)
//        ->get();

//        $comments->load(['replies']);
//        Comment::with('replies')->get();
//        $myFs=Comment::find(39)->replies()->get();
//        dd($myFs[1]->body);
//        foreach ($myFs as $myF){
//            return $myF;
//        }

//        $replies=Reply::where('replyable_type','App\Models\Reply')->get();

        $likes = Like::where('likeable_id',$blog->id)
            ->max('count');
        $comments=Comment::with('replies')
            ->whereNull('parent_id')
            ->where('commentable_type','=','App\Models\Blog')
            ->where('commentable_id','=',$blog->id)
            ->where('published','=','1')
            ->get();

//        $myCom=$comments->first();
//        dd($myCom->replies);
//        $comments->load('replies');
        return view('admin.blog.show',compact(['blog','likes','comments']));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $data =$request->validated();
        $blog->update($data);
        return redirect(route('admin.blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect(route('admin.blog.index'));
    }
}
