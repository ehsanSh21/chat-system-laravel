<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Services\Blog\BlogService;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private BlogService $blogService)
    {

    }

    public function index()
    {
        $blogs=Blog::all();
        return $this->successResponse(BlogResource::collection($blogs));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request,Blog $blog)
    {
        $blog= $this->blogService->store($blog,$request->validated());
        return $this->successResponse(BlogResource::make($blog),'بلاگ ساخته شد',201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return $this->successResponse(BlogResource::make($blog));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $this->blogService->update($blog,$request->validated());
//        $blog->update(($request->validated()));
        return $this->successResponse(BlogResource::make($blog),'پست آگدیت شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $this->blogService->delete($blog);
        return $this->successResponse(BlogResource::make($blog),'پست حإف شد');
    }
}
