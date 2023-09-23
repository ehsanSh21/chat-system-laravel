<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
//         ]);

//        $this->call([
//            UserSeeder::class,
//            CategorySeeder::class,
//            BrandSeeder::class,
//            BlogSeeder::class,
//            ProductSeeder::class,
//        ]);

        User::factory(10)->create()->each(function ($user) {


            Product::factory(1)
                ->create([
                    'user_id' => $user->id
                ])->each(function (Product $product) use ($user) {
                    foreach (range(1, rand(3, 6)) as $item) {
                        $product->likes()->create([
                            'user_id' => $user->id,
                            'created_at' => Carbon::now()->subDays(rand(1, 20))
                        ]);
                    }
                    foreach (range(1, rand(3, 6)) as $item) {
                        $product->views()->create([
                            'user_id' => $user->id,
                            'created_at' => Carbon::now()->subDays(rand(1,20))
                        ]);
                    }
                });


            $order = Order::factory()->create(['user_id' => $user->id]);
            OrderItem::factory(2)->create([
                'order_id' => $order->id,
                'product_id' => Product::inRandomOrder()->first()->id
            ]);


        });

//        Product::factory(6)->create([
//            'category_id'=>22,
//        ]);



    }
}
