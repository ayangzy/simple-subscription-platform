<?php

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\subscriptions\UserSubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('posts/create', [PostController::class, 'store'])->name('create.post');
Route::post('user/subscription', [UserSubscriptionController::class, 'subscribe'])->name('subscription');
