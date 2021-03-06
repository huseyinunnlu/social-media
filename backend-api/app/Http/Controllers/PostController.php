<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;
use App\Models\PostGallery;
use App\Models\PostLike;
use App\Models\PostSave;
use App\Models\PostComment;
use App\Models\PostCommentLike;
use App\Models\PostCommentReply;

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

    public function like(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'postId'=>'required',
        ]);

        $post = PostLike::where('user_id',$request->userId)->where('post_id',$request->postId)->first();

        if ($post) {
            return response()->json([
                'message'=>'You already liked'
            ],404);
        }

        PostLike::create([
            'user_id'=>$request->userId,
            'post_id'=>$request->postId,
        ]);

        return response()->json([
            'message'=>'ok'
        ],200);
    }

    public function unLike(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'postId'=>'required',
        ]);

        $post = PostLike::where('user_id',$request->userId)->where('post_id',$request->postId)->first();

        if($post){
            PostLike::where('user_id',$request->userId)->where('post_id',$request->postId)->first()->delete();
            return response()->json([
                'message'=>'ok',
            ],200);
        }else{
            return response()->json([
                'message'=>'Didnt unliked',
            ],404);
        }
    }

    public function save(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'postId'=>'required',
        ]);

        $post = PostSave::where('user_id',$request->userId)->where('post_id',$request->postId)->first();

        if($post){
            return response()->json([
                'message'=>'You already saved this post'
            ],404);
        }
        PostSave::create([
            'user_id'=>$request->userId,
            'post_id'=>$request->postId,
        ]);
        return response()->json([
            'message'=>'ok'
        ],200);

    }


    public function unSave(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'postId'=>'required',
        ]);

        $post = PostSave::where('user_id',$request->userId)->where('post_id',$request->postId)->first();

        if($post){
            PostSave::where('user_id',$request->userId)->where('post_id',$request->postId)->first()->delete();
            return response()->json([
                'message'=>'ok',
            ],200);
        }else{
            return response()->json([
                'message'=>'Didnt unsaved',
            ],404);
        }
    }

    public function addPostComment(Request $request)
    {
        $request->validate([
            'postId'=>'required',
            'userId'=>'required',
            'comment'=>'required|max:255',
        ]);

        PostComment::create([
            'post_id'=>$request->postId,
            'user_id'=>$request->userId,
            'comment'=>$request->comment,
        ]);

        $last = PostComment::orderBy('id','desc')->select('id')->first();
        if (!$last) {
            $last->id = 0;
        }
        return response()->json([
            'id'=> $last->id,
        ]);
    }

    public function getPostArticle(Request $request)
    {
        $postArticle = Post::where('url',$request->url)->with('galleries','user')->withCount('like')->first();
        if ($postArticle) {
            return response()->json($postArticle);
        }
        return response()->json([
            'message'=>'Post not found.',
        ],404);
    }

    public function getPostComments(Request $request)
    {
        $comments = PostComment::where('post_id',$request->postId)->with('user','reply.user')->withCount('like','reply')->orderBy('created_at','desc')->limit($request->count)->get();
        return response()->json($comments);
    }

    public function likeComment(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'commentId'=>'required',
            'type'=>'required',
        ]);

        $likeComment = PostCommentLike::where('user_id',$request->userId)->where('comment_id',$request->commentId)->where('type',$request->type)->first();
        if ($likeComment) {
            return response()->json([
                'message'=>'You already liked this comment',
            ],404);
        }else{
            PostCommentLike::create([
                'user_id'=>$request->userId,
                'comment_id'=>$request->commentId,
                'type'=>$request->type,
            ]);
            return response()->json([
                'message'=>'Successfully liked.',
            ],200);
        }
    }
    public function unLikeComment(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'commentId'=>'required',
            'type'=>'required',
        ]);

        $likeComment = PostCommentLike::where('user_id',$request->userId)->where('comment_id',$request->commentId)->where('type',$request->type)->first();
        if (!$likeComment) {
            return response()->json([
                'message'=>'You already didnt liked this comment.',
            ],404);
        }else{
            PostCommentLike::where('user_id',$request->userId)->where('comment_id',$request->commentId)->where('type',$request->type)->first()->delete();
            return response()->json([
                'message'=>'Successfully unliked.',
            ],200);
        }
    }

    public function deleteComment(Request $request)
    {
        $request->validate([
            'commentId'=>'required',
        ]);

        $comment = PostComment::whereId($request->commentId)->first();
        if ($comment) {
            PostComment::whereId($request->commentId)->first()->delete();
            return response()->json([
                'message'=>'Successfully deleted.',
            ],200);
        }else{
            return response()->json([
                'message'=>'Comment not found.',
            ],404);
        }
    }

    public function deletePost(Request $request)
    {
        $request->validate([
            'postId'=>'required',
        ]);
        $post = Post::whereId($request->postId)->first()->delete();
        if ($post == 1) {
            return response()->json([
                'message'=>'Post successfully deleted',
            ],200);
        }else{
            return response()->json([
                'message'=>"Post did't deleted",
            ],404);
        }
    }

    public function addCommentReply(Request $request){

        $request->validate([
            'postId'=>'required',
            'userId'=>'required',
            'commentId'=>'required',
            'replyUserId'=>'required',
            'reply'=>'required|max:255',
        ]);
        PostCommentReply::create([
            'post_id'=>$request->postId,
            'user_id'=>$request->userId,
            'comment_id'=>$request->commentId,
            'reply_user_id'=>$request->replyUserId,
            'reply'=>$request->reply,
        ]);

        $lastReply = PostCommentReply::orderBy('id','desc')->first();
        return response()->json([
            'id'=>$lastReply->id,
        ],200);
    }
}
