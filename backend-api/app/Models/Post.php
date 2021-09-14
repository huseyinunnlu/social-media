<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['url','user_id','desc','isLikeable','isCommentable','isViewable'];
    
    protected $appends = ['isLiked','isSaved'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User'::class, 'user_id');
    }

    public function galleries()
    {
        return $this->hasMany('App\Models\PostGallery'::class, 'post_id');
    }

    public function like()
    {
        return $this->hasMany('App\Models\PostLike'::class, 'post_id');
    }

    public function saves()
    {
        return $this->hasMany('App\Models\PostSave'::class, 'post_id');
    }

    public function getIsLikedAttribute()
    {
        if (Auth()->user()) {
            $user = $this->like()->where('user_id',Auth()->user()->id)->first();
            if ($user) {
                return true;
            }else{
                return false;
            }
        }else {
            return false;
        }
    }
    public function getIsSavedAttribute()
    {
        if (Auth::user()) {
            $user = $this->saves()->where('user_id',Auth::user()->id)->first();
            if ($user) {
                return true;
            }else{
                return false;
            }
        }else {
            return false;
        }
    }
}
