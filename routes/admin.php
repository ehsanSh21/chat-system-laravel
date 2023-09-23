<?php

use App\Http\Controllers\Admin\{
    BlogController,
    ProductController,
    UserController,
};

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|\
*/


    Route::get('/', function () {
        $notRead=\App\Models\Message::where('chat_partner',auth()->user()->id)
            ->where('chat_partner_seen')
            ->count();
        return view('admin.dashboard.dashboard');
    });

    Route::resource('user', UserController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('product', ProductController::class);

    Route::get('/product/buy/{product}',[ProductController::class,'buy'])->name('product.buy');
    Route::get('/product/order/{basket}',[ProductController::class,'comOrder'])->name('product.order');
    Route::post('/product/order/{basket}',[ProductController::class,'kharid'])->name('product.kharid');
    Route::get('/product/order-cancel/{product}',[ProductController::class,'cancel'])->name('product.order-cancel');
    Route::get('/products/generate',[ProductController::class,'generate'])->name('products.generate');
    Route::get('/products/final/{basket}',[ProductController::class,'final'])->name('products.final');
    Route::get('/products/orders',[ProductController::class,'orders'])->name('products.orders');
    Route::get('/products/order-items/{order}',[ProductController::class,'orderItems'])->name('products.order-items');
    Route::get('/products/orderByQty',[ProductController::class,'orderByQty'])->name('products.orderByQty');
    Route::get('/products/orderByItems',[ProductController::class,'orderByItems'])->name('products.orderByItems');
    Route::get('/products/orderByMostProfit',[ProductController::class,'orderByMostProfit'])->name('products.orderByMostProfit');
    Route::get('/products/bestSellingProducts',[ProductController::class,'bestSellingProducts'])->name('products.bestSellingProducts');



Route::get('/chatPartner',[\App\Http\Controllers\MessageController::class,'index'])->name('chat');
Route::get('/messages/{user}',[\App\Http\Controllers\MessageController::class,'show'])->name('message');
Route::post('/store-messages/{user}',[\App\Http\Controllers\MessageController::class,'store'])->name('store.message');
Route::post('/reply-messages/{user}/{message}',[\App\Http\Controllers\MessageController::class,'reply'])->name('reply.message');
Route::get('/reply-messages/{user}',[\App\Http\Controllers\MessageController::class,'pin'])->name('user.pin');
