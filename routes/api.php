<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------

| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/test',[\App\Http\Controllers\TestController::class,'index']);

Route::middleware('auth:sanctum')->get('/profile', function ()
{
    return \request()->user();
});

Route::apiResource('user',\App\Http\Controllers\Api\UserController::class);

Route::apiResource('blog',\App\Http\Controllers\Api\BlogController::class);






