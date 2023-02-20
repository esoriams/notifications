<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UsersResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\NotificationTypeResource;
use App\Http\Models\User;
use App\Http\Models\Channel;
use \App\Http\Notifications\Types\Sms;
use \App\Http\Notifications\Types\Email;
use \App\Http\Notifications\Types\Push;

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

Route::get('/notification-types', function () {
    return new NotificationTypeResource(Channel::all());
});

Route::post('/notification/{channelId}', function($channelId, Request $request) {
    switch ($channelId){
        case 1:
            return response()->json(Sms::notificate($request->all()));
        case 2:
            return response()->json(Email::notificate($request->all()));
        case 3:
            return response()->json(Push::notificate($request->all()));
    }
});


