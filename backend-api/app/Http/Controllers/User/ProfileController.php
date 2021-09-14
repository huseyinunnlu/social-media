<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;
use App\Models\PostSave;

class ProfileController extends Controller
{
    public function get($username)
    {
        $user = User::where('username',$username)->withCount('post')->withCount('followers','following')->first();

        if($user) {
            return response()->json($user);
        }else{
            return response()->json([
                'message'=>'User not found.'
            ],404);
        }
    }

    public function getfollowers(Request $request)
    {
        $followers = Follow::where('follow_id',$request->user)->with('FollowerUser')->limit($request->count)->get();
        return response()->json($followers);
    }

    public function getfollows(Request $request)
    {
        $followers = Follow::where('follower_id',$request->user)->with('FollowUser')->limit($request->count)->get();
        return response()->json($followers);
    }

    public function getUserPosts(Request $request)
    {
        $userPosts = Post::where('user_id',$request->user)->with('galleries','user')->withCount('galleries')->limit($request->count)->get();
        return response()->json($userPosts);
    }

    public function getUserSavedPosts(Request $request)
    {
        $savedId = [];
        $savedIds = PostSave::where('user_id',$request->user)->orderBy('created_at','desc')->select('post_id','id')->limit($request->count)->get();
        
        foreach($savedIds as $saved){
            array_push($savedId, $saved->post_id);
        }
        $userSavedPosts = Post::whereIn('id',$savedId)->with('galleries','user')->withCount('galleries')->limit($request->count)->get();
        return response()->json($userSavedPosts);
    }

    public function follow(Request $request)
    {
        $request->validate([
            'followId'=>'required',
            'followerId'=>'required',
        ]);

        if ($request->followerId === Auth::user()->id && $request->followerId !== $request->followId) {
            $follow = Follow::where('follow_id',$request->followId)->where('follower_id',$request->followerId)->first();
            if(!$follow){
                Follow::create([
                    'follow_id'=>$request->followId,
                    'follower_id'=>$request->followerId,
                ]);
            }else{
                return response([
                    'error'=>'You are already following',
                ],404);
            }
        }else{
            return response([
                'error'=>'You cannot follow yourself',
            ],404);
        }
    }

    public function unFollow(Request $request)
    {
        $request->validate([
            'followId'=>'required',
            'followerId'=>'required',
        ]);

        if ($request->followerId === Auth::user()->id && $request->followerId !== $request->followId) {
            Follow::where('follow_id',$request->followId)->where('follower_id',$request->followerId)->first()->delete();
        }else{
            return response([
                'error'=>'You cannot unfollow yourself',
            ],404);
        }
    }

    public function removeFollower(Request $request)
    {
        Follow::whereId($request->id)->first()->delete();
    }
}
