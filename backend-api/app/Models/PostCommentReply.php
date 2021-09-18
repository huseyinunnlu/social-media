<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCommentReply extends Model
{
    use HasFactory;
    protected $table = 'post_comment_relies';
    protected $fillable = ['user_id','comment_id','post_id','reply_user_id','reply'];
}
