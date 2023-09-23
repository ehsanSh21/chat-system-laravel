<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $users  = User::all();
//        foreach ($users as $user){
//            Category::factory(2)->create([
//                'user_id'=>$user->id,
//            ]);
//        }

        Category::factory(20)->create();

    }
}
