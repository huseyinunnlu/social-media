<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;
use App\Models\PostGallery;

class IndexController extends Controller
{
    public function suggestedAccounts()
    {
        $accs = User::whereNotIn('id',[Auth::user()->id])->inRandomOrder()->limit(5)->get();
        return response()->json($accs);
    }

    public function getPosts()
    {
        $posts = Post::with('user','galleries')->withCount('galleries')->get();
        return response()->json($posts);
    }  
}
