<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $table = 'post_comments';
    protected $fillable = ['user_id','post_id','comment'];

    public function user()
    {
        return $this->belongsTo('App\Models\User'::class, 'user_id');
    }

    public function like()
    {
        return $this->hasMany('App\Models\PostCommentLike'::class, 'comment_id');
    }

    protected $appends = ['isLiked'];

    public function getIsLikedAttribute()
    {
        if (Auth()->user()) {
            $isLiked = $this->like()->where('user_id',Auth()->user()->id)->first();
            if ($isLiked) {
                return true;
            }else{
                return false;
            }
        }else {
            return false;
        }
    }

    public function reply()
    {
        return $this->hasMany('App\Models\PostCommentReply'::class, 'comment_id');
    }
}
