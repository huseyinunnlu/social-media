<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyCode extends Model
{
    use HasFactory;
    protected $table = 'verify_codes';
    protected $fillable = ['user_id','email','code','start_date','expire_date','type'];
    public $timestamps = false;
}
