<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    protected $table = 'follows';
    protected $fillable = ['follow_id','follower_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User'::class, 'follower_id');
    }
}
