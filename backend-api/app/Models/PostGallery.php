<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostGallery extends Model
{
    use HasFactory;
    protected $table = 'post_galleries';
    protected $fillable = ['post_id','user_id','file_url'];
}
