<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\ProfileSettingsController;
use App\Http\Controllers\User\ProfileController;
use App\Models\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = User::whereId(Auth::user()->id)->withCount('followers','following')->first();
    return $user;
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');
Route::post('/account/edit', [ProfileSettingsController::class, 'accountEdit'])->middleware('auth:api');
Route::post('/sendmailcode', [ProfileSettingsController::class, 'sendVerifyMailCode'])->middleware('auth:api');
Route::post('/verifyemail', [ProfileSettingsController::class, 'verifyEmail'])->middleware('auth:api');
Route::post('/account/edit/updateimage', [ProfileSettingsController::class, 'updateImage'])->middleware('auth:api');
Route::post('/account/password/change', [ProfileSettingsController::class, 'updatePassword'])->middleware('auth:api');
Route::get('/user/{username}', [ProfileController::class, 'get'])->middleware('auth:api');
Route::post('/follow', [ProfileController::class, 'follow'])->middleware('auth:api');
Route::post('/unfollow', [ProfileController::class, 'unFollow'])->middleware('auth:api');
Route::post('/removefollower', [ProfileController::class, 'removeFollower'])->middleware('auth:api');
Route::get('/getfollowers', [ProfileController::class, 'getFollowers']);
Route::get('/getfollows', [ProfileController::class, 'getFollows']);