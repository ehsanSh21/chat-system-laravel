<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

//        $users  = User::all();
//        $users_count = User::count();
//        $products = Product::all();
//        $products_count = Product::count();
//        $blogs = Blog::all();
//
//        foreach ($products as $product){
//            Comment::factory(rand(1,3))
//                ->create([
//                   'commentable_type'=>'App\Models\Product',
//                    'commentable_id'=>$product->id,
//                    'user_id'=>$users[rand(0,$users_count-1)]->id,
//                ]);
//        }
//
//        foreach ($blogs as $blog){
//            Comment::factory(rand(1,3))
//                ->create([
//                    'commentable_type'=>'App\Models\Blog',
//                    'commentable_id'=>$blog->id,
//                    'user_id'=>$users[rand(0,$users_count-1)]->id,
//                ]);
//        }
    }
}
