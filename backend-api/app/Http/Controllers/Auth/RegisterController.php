<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullname'=>'required|max:50',
            'username' => 'required|string|alpha_dash|min:3|max:25|unique:users|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|alpha_dash',
        ]);

        User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'image' => 'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg',
        ]);

        return response()->json('Successfully Registered.');
    }
}
