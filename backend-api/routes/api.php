<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\ProfileSettingsController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
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
Route::get('/suggestedaccs', [IndexController::class, 'suggestedAccounts'])->middleware('auth:api');
Route::post('/addpost', [PostController::class, 'addPost'])->middleware('auth:api');
Route::get('/getposts', [IndexController::class, 'getPosts'])->middleware('auth:api');
Route::get('/getuserposts', [ProfileController::class, 'getUserPosts'])->middleware('auth:api');
Route::get('/getusersavedposts', [ProfileController::class, 'getUserSavedPosts'])->middleware('auth:api');
Route::post('/like', [PostController::class, 'like'])->middleware('auth:api');
Route::post('/unlike', [PostController::class, 'unLike'])->middleware('auth:api');
Route::post('/save', [PostController::class, 'save'])->middleware('auth:api');
Route::post('/unsave', [PostController::class, 'unSave'])->middleware('auth:api');
Route::post('/addpostcomment', [PostController::class, 'AddPostComment'])->middleware('auth:api');
Route::get('/getpostarticle', [PostController::class, 'getPostArticle'])->middleware('auth:api');
Route::get('/getpostcomments', [PostController::class, 'getPostComments'])->middleware('auth:api');
Route::post('/likecomment', [PostController::class, 'likeComment'])->middleware('auth:api');
Route::post('/unlikecomment', [PostController::class, 'unLikeComment'])->middleware('auth:api');
Route::post('/deletecomment', [PostController::class, 'deleteComment'])->middleware('auth:api');
Route::post('/deletepost', [PostController::class, 'deletePost'])->middleware('auth:api');