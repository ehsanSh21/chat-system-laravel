<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Route::group(["prefix" => 'admin','as'=>'admin.'],function (){
//
//    Route::get('/', function () {
//        return view('admin.dashboard.dashboard');
//    });
//
//    Route::resource('user', UserController::class);
//    Route::resource('blog', BlogController::class);
//    Route::resource('product', ProductController::class);
//
//});

Route::get('/exer', function () {

    return collect([1,2,3])
    ->reduce(function($item){
        return $item += $item;

    });
});


Route::get('/approve/{id}',[CommentController::class,'approve']);
Route::post('/comment/store/{blog}',[CommentController::class,'store'])->name('comment.store');
Route::post('/comment/reply/{id}/{depth}',[CommentController::class,'reply'])->name('reply.store');



//Auth::routes();
Route::get('/login',[\App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[\App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::post('/logout',[\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

Route::get('/register',[\App\Http\Controllers\Auth\RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register',[\App\Http\Controllers\Auth\RegisterController::class,'register'])->name('register');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::patch('/like/{type}/{id}',[LikeController::class,'like'])->name('like');

///////////service Co////

Route::get('/serv',[\App\Http\Controllers\PayController::class,'store']);


Route::get('/aa',function () {

//   $users=DB::table('users')
//       ->select([
//           'users.id',
//           'users.name',
//           'blogs.user_id',
//           'blogs.id as blog_id',
//           'blogs.body',
//           'blogs.description',
//       ])->leftJoin('blogs','users.id','=','blogs.user_id')
//       ->get()
//       ;


//    $users=DB::table('users')
//        ->select(['name','id'])
//        ->where('name','like','e%')
//        ->orWhere('name','like','v%')
//        ->whereIn('id',function ($query){
//            $query->select('id')->from('users')
//                ->where('id','2');
//        })
//        ->get()
//    ;


//
//   return $users;
});













Route::get('/mosh', function () {

    $user = 5;
    for ($i = 1; $i <= $user ; $i++) {
        $money=[40,20,30,1];
    }
//    dd($money);

//    $b =0;
    foreach ($money as $item) {
        $b=$item;
      if ($item<$b){
          $b=$item;
      }
    }
    dd([$money,$b]);











});














