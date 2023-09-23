<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\DiscountCode;
use App\Models\Product;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Query\Builder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Order;
use Carbon\Carbon;
use DB;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $user = User::first();
        $product = Product::first();
        $blog = Blog::first();

//        $user->like(1);
//        $product->like(1);
//        $blog->like(1);

//        $role = Role::first();
//        $permission = Permission::find(2);
//
//        $role->givePermissionTo($permission);
//        $user->assignRole('writer');
//        Permission::create([
//            'name'=>'delete articles'
//        ]);

//        $user->givePermissionTo('delete articles');
//        $myper=$user->roles->permissions->pluck('name');
//        dd($myper);
        dd($user->can('delete articles'));


        $response->assertStatus(200);
    }

    public function test_that_true_is_true(): void
    {

        $que02 = User::whereHas('blogs', function ($q) {
            $q->where('title', 'like', 'Prof%');
        })->withCount(['blogs' => function ($q) {
            $q->where('title', 'like', 'Prof%');
        }])
            ->get();

        $que98 = Blog::
        with(['comments.user'])
            ->get();

        $que77 = User::with(['blogs' => function ($q) {
            $q->latest()->take(1);
        }])->get();


        $que37 = Blog::with('category')->withCount('comments')->get();


        $que00 = User::whereHas('blogs', function ($q) {
            $q->withCount('comments');
        })->with(['blogs' => function ($q) {
            $q->has('comments');
            $q->withCount('comments');
        }])
            ->get();


        $que64 = User::whereHas('blogs', function ($q) {
            $q->whereHas('category', function ($q) {
                $q->where('name', 'id');
            });
        })->with(['blogs' => function ($q) {
            $q->whereHas('category', function ($q) {
                $q->where('name', 'id');
            });
        }])->get();


        $que83 = User::whereHas('blogs', function ($q) {
            $q->whereHas('comments', function ($q) {
                $q->whereHas('user', function ($q) {
                    $q->where('id', 7);
                });
            });
        })->with(['blogs' => function ($q) {
            $q->whereHas('comments', function ($q) {
                $q->whereHas('user', function ($q) {
                    $q->where('name', "Jaquan");
                });
            });
            $q->with(['comments' => function ($q) {
                $q->whereHas('user', function ($q) {
                    $q->where('name', "Jaquan");
                });
            }]);
        }])->get();


        $users44 = User::whereHas('blogs.comments.user', function ($query) {
            $query->where('name', "Jaquan");
        })->get();


        $que94 = User::whereHas('blogs.comments.user', function ($query) {
            $query->where('name', "Jaquan");
        })->with('blogs.comments.user')->get();

        $users22 = User::whereHas('blogs.comments.user', function ($query) {
            $query->where('name', "Jaquan");

        })->with(['blogs.comments' => function ($query) {
            $query->whereHas('user', function ($query) {
                $query->where('name', "Jaquan");
            });
            $query->with('user');
        }])->get();

        $users77 = User::whereHas('blogs.comments.user', function ($query) {
            $query->where('name', 'John');
        })->with(['blogs.comments.user' => function ($query) {
            $query->where('name', 'John');
        }])->get();


        $users34 = User::whereHas('blogs.comments.user', function ($query) {
            $query->where('name', 'John');
        })->with([
            'blogs' => function ($query) {
                $query->whereHas('comments.user', function ($query) {
                    $query->where('name', 'John');
                })->with([
                    'comments' => function ($query) {
                        $query->whereHas('user', function ($query) {
                            $query->where('name', 'John');
                        })->with('user');
                    }
                ]);
            }
        ])->get();

        //Retrieve all users who have at least one post with a comment
        //, and count the number of comments for each user.

        //Retrieve all users who have at least one post with a comment,
        // and order them by the number of comments in descending order.

        $posts = Blog::whereHas('comments.user', function ($query) {
            $query->where('name', 'John');
        })->with([
            'comments' => function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('name', 'John');
                })->with('user');
            }
        ])->get();


        $que234 = Blog::has('comments')->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->get();

        $que66 = Blog::whereHas('comments.user', function ($q) {
            $q->where('name', "John");
        })->withCount(['comments' => function ($q) {
            $q->whereHas('user', function ($q) {
                $q->where('name', "John");
            });
        }])
            ->orderBy('comments_count', 'desc')
            ->get();


        //Retrieve all users who have at least one post with a comment,
        // and only retrieve the posts and comments
        // that were created in the last week.

        $que45 = User::whereHas('blogs.comments', function ($query) {
            $query->where('created_at', '>=', now()->subWeek());
        })->with([
            'blogs' => function ($query) {
                $query->whereHas('comments', function ($query) {
                    $query->where('created_at', '>=', now()->subWeek());
                })->with([
                    'comments' => function ($query) {
                        $query->where('created_at', '>=', now()->subWeek());
                    }
                ]);
            }
        ])->get();


        dd($que45->toArray());


        $query1 = Product::withCount('views')
            ->orderBy('views_count', 'desc')
            ->limit(7)
//            ->orderBy('id','desc')
            ->get();

//        $product=Product::find(144);

        $query2 = Product::withCount('views')
            ->where(function ($q) {
                $q->where('created_at', '<', Carbon::now());
            })
            ->where(function ($q) {
                $q->where('created_at', '>', Carbon::now()->subDay(7));
            })
            ->orderBy('views_count', 'desc')
            ->limit(4)
            ->get();


        $query3 = Product::
        withCount([
            'views' => function ($q) {
                $q->where('created_at', '<', Carbon::now());
                $q->where('created_at', '>', Carbon::now()->subDays(7));
            }
        ])

//            ->where('views_count','>',1)
            ->orderBy('views_count', 'desc')
            ->limit(4)
            ->get();


        $query76 = Product::withCount(['orderItems'])
            ->has('orderItems')
            ->orderByDesc('order_items_count')
            ->get();

//        dd($query76->toArray());


        $query33 = Order::whereHas('items', function ($q) {
            $q->where('qty', '<=', 2);
        })
            ->with([
                'items' => function ($q) {
                    $q->where('qty', '<=', 2);
                }
            ])
            ->get();
//       dd($query33->toArray());


//        $query = Product::withCount(['likes'])
//            ->whereDate('created_at', '<=', Carbon::now())
//            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
//            ->orderBy('likes_count', 'desc')
//            ->limit(4)
//            ->get();
        $query44 = Product::query()
            ->withCount([
                'orderItems AS order_items_sum' => function ($query) {
                    $query->select(DB::raw("SUM(qty*price) as paidsum"));
                }
            ])
            ->orderBy('order_items_sum', 'desc')
            ->limit(5)
            ->get();
//        dd($query44->toArray());

        $user = User::find(11);
//        dd($user);
//        Order::query()->where('user_id',$user->id)->items()->

//        $query=Product::query()
//            ->withCount([
//                'orderItems AS order_items_sum' => function ($query) use($user) {
//                    $query->whereHas('order',function ($query) use($user){
//                            $query->where('user_id',$user->id);
//                        })
//                        ->select(DB::raw("SUM(qty) as paidsum"));
//                }
//            ])
//            ->orderBy('order_items_sum','desc')
//            ->limit(10)
//            ->get();


//        $duplicates = DB::table('orders')
//            ->whereIn('id', function ($q){
//                $q->select('id')
//                    ->from('orders')
//                    ->groupBy('user_id')
//                    ->havingRaw('COUNT(*) > 1');
//            })->get();

        $duplicates = DB::table('orders')
            ->select([
                'user_id',
                DB::raw("COUNT('id')"),
            ])
            ->groupBy('user_id')
            ->get();
        dd($duplicates->toArray());


        $query02 = User::has('orders')
            ->with([
                'orders' => function ($q) {
                    $q->havingRaw('COUNT(*) > 1');
                }
            ])
            ->limit(10)->get();
        dd($query02->toArray());

        $query55 = Product::query()
            ->whereHas('orderItems', function ($query) use ($user) {
                $query->whereHas('order', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->withCount(['orderItems' => function ($query) use ($user) {
                $query->whereHas('order', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            }])
            ->limit(4)
            ->get();

        dd($query55->toArray());

        $this->assertTrue(true);
    }

    public function test_discount(): void
    {
        DiscountCode::create([
            'code' => 'KLKLK',
            'category_id' => 22,
            'discount_percent' => 50,
        ]);

        dd('sdfs');

        $this->assertTrue(true);
    }

    public function test_query(): void
    {
        //Retrieve all posts that have been
        //published in the last month and have a rating greater
        //than the average rating of the user who posted the post.

//        $sddf=Product::where('created_at','>=',Carbon::now()->subMonths())
//            ->
//
//        dd($sddf);

//        dd('dfsf');

        $sdf = Product::find(43);
//        dd($sdf);

        $dd = Product::where('id', 43)->whereHas('orderItems', function ($q) {
            $q->where('isComplited', true);
//            $q->whereHas('order',function ($q){
//                $q->where('user_id',auth()->user()->id);
//            });
        })->get();

        dd($dd);
        $this->assertTrue(true);
    }

    public function test_sth(): void
    {
        $arr = array(2, 5, 1, 7, 4);

        for ($i = 0; $i < count($arr); $i++) {
            for ($j = 0; $j < count($arr) - 1; $j++) {
                if ($arr[$j + 1] < $arr[$j]) {
                    $temp = $arr[$j + 1];
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
//        dd($arr);

        $products = [];

        for ($i = 0; $i < 5; $i++) {
            $products[] = ['name' => "pr" . $i,
                'price' => rand(100, 500),
                'date' => Carbon::now()->subDays(rand(1, 365))->toDateString(),
            ];

        }

//        dd($products[0]['price']);

        for ($i = 0; $i < count($products); $i++) {
            for ($j = 0; $j < count($products) - 1; $j++) {
                if ($products[$j + 1]['date'] < $products[$j]['date']) {
                    $temp = $products[$j + 1];
                    $products[$j + 1] = $products[$j];
                    $products[$j] = $temp;
                }
            }


        }


        dd($products);
    }

}
