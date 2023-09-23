<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $users  = User::all();
//        $categories= Category::all();
//        $categories_count= Category::count();
//        $brands= Brand::all();
//        $brands_count= Brand::count();
//
//        foreach ($users as $user){
//            Product::factory(rand(1,3))
//                ->hasImages(rand(1,3))
//                ->create([
//                    'user_id'=>$user->id,
//                    'category_id'=>$categories[rand(0,$categories_count-1)]->id,
//                    'brand_id' => $brands[rand(0,$brands_count-1)]->id,
//                ]);
//        }

        Product::factory(25)
            ->hasImages(rand(1,3))
            ->hasComments(3)
            ->create();
    }
}
