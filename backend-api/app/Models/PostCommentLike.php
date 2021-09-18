<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCommentLike extends Model
{
    use HasFactory;
    protected $table = 'post_comment_likes';
    protected $fillable = ['user_id','comment_id','type'];
    public $timestamps = false;
}
