<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;
use App\Models\PostGallery;

class PostController extends Controller
{
    public function addPost(Request $request)
    {
        $request->validate([
            'desc'=>'max:255|nullable',
            'isLikeable'=>'required',
            'isCommentable'=>'required',
            'isViewable'=>'required',
        ]);

        $key = '';
        $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        for($i=0; $i <= 50; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        Post::create([
            'user_id'=>Auth()->user()->id,
            'url'=>$key,
            'desc'=>$request->desc,
            'isLikeable'=>$request->isLikeable,
            'isCommentable'=>$request->isCommentable,
            'isViewable'=>$request->isViewable,
        ]);

        $lastPost = Post::where('user_id',Auth::user()->id)->orderBy('id','desc')->select('id')->first();
        for($i=0; $i <= $request->imageCount; $i++){
            if ($request->image[$i]) {
                $key = '';
                $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
                for($j=0; $j <= 35; $j++) {
                    $key .= $keys[array_rand($keys)];
                }
                $imageName = 'http://localhost:8000/uploads/posts/'.$key.Auth()->user()->id.$request->image[$i]->getClientOriginalName();
                $request->image[$i]->move(public_path('uploads/posts'), $imageName);
                PostGallery::create([
                    'post_id'=>$lastPost->id,
                    'user_id'=>Auth()->user()->id,
                    'file_url'=>$imageName,
                ]);
            }
        }
    }
    
}
