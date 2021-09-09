<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['url','user_id','desc','isLikeable','isCommentable','isViewable'];

    public function user()
    {
        return $this->belongsTo('App\Models\User'::class, 'user_id');
    }

    public function galleries()
    {
        return $this->hasMany('App\Models\PostGallery'::class, 'post_id');
    }
}
