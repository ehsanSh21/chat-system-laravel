<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $users  = User::all();
//        $categories= Category::all();
//        $categories_count= Category::count();
//        foreach ($users as $user){
//            Blog::factory(rand(1,2))
//                ->hasImage(1)
//                ->create([
//                'user_id'=>$user->id,
//                'category_id'=>$categories[rand(0,$categories_count-1)]->id,
//            ]);
//        }

        Blog::factory(20)
            ->hasImage(1)
            ->hasComments(2)
            ->create();

    }
}
