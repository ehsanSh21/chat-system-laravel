<?php

namespace App\Http\Services\Blog;

use App\Http\Services\ApiBaseService;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class BlogService extends ApiBaseService
{

    public function __construct()
    {
    }

//    public function store(array $payload): Blog
//    {
//        return Blog::create($payload);
//    }
//
//    public function update(Blog $blog, array $payload): Blog
//    {
//     return $blog->update($payload);
//    }
//
//    public function delete(Blog $blog)
//    {
//        return $blog->delete();
//    }

}
