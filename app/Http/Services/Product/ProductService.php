<?php

namespace App\Http\Services\Product;

use App\Http\Services\Blog\BlogService;
use Illuminate\Support\Facades\Log;

class ProductService
{
    private BlogService $blogService;

    public function __construct(BlogService $blogService)
{
    Log::info('prodConst');
    $this->blogService = $blogService;
}


}
