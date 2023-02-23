<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UsersResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\NotificationsResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Models\User;
use App\Http\Models\Category;
use App\Http\Models\Message;

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

Route::get('/users', function () {
    return new UsersResource(User::all());
});

Route::get('/user/{id}', function ($id) {
    return new UserResource(User::findOrFail($id));
});

Route::get('/categories', function () {
    return new CategoriesResource(Category::all());
});

Route::get('/notifications', function () {
    /** @var $blockSize */
    $blockSize = 10;
    return NotificationsResource::collection(Message::OrderBy('created_at', 'desc')->paginate($blockSize)
                            );
});

Route::post('/notification/', function( Request $request) {
    $notifications = Message::Send($request->get('category_id'), $request->get('message'));
    return NotificationsResource::collection($notifications);
});
