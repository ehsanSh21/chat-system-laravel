<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = User::factory(10)
            ->hasImage(1)
            ->create();

         foreach ($users as $user){
             $user->createToken('exam')->plainTextToken;
         }
    }
}
