<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;


class ProfileSettingsController extends Controller
{
    public function accountEdit(Request $request)
    {
        $request->validate([
            'fullname'=>'required|max:50',
            'username'=>'required|string|alpha_dash|min:3|max:25|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/|unique:users,username,'.Auth::user()->id,
            'email'=>'required|email|unique:users,email,'.Auth::user()->id,
            'bio'=>'nullable|max:150',
            'phone'=>'nullable|unique:users,phone,'.Auth::user()->id,
            'gender'=>'required',
            'acctype'=>'required',
        ]);
        $isPhoneVerified = Auth()->user()->isPhoneVerified;
        $isEmailVerified = Auth()->user()->isEmailVerified;

        if($request->email == Auth()->user()->email){
            $request->email_verified_at = null;
            $isPhoneVerified = '0';
        }
        if($request->phone == Auth()->user()->phone){
            $request->phone_verified_at = null;
            $isEmailVerified = '0';
        }

        if($request->id == Auth()->user()->id){
            User::whereId(Auth()->user()->id)->first()->update([
                'fullname'=>$request->fullname,
                'username'=>$request->username,
                'email'=>$request->email,
                'bio'=>$request->bio,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'email_verified_at'=>$request->email_verified_at,
                'phone_verified_at'=>$request->phone_verified_at,
                'isEmailVerified' => $isEmailVerified,
                'isPhoneVerified' => $isPhoneVerified,
                'acctype' => $request->acctype,
            ]);
        }
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image'=>'required|max:1024|mimes:jpg,jpeg,png',
        ]);
        $key = '';
        $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        for($i=0; $i <= 25; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        $imageName = 'http://localhost:8000/uploads/'.$key.$request->image->getClientOriginalName();
        $request->image->move(public_path('uploads'), $imageName);
        User::whereId(Auth::user()->id)->first()->update([
            'image'=>$imageName,
        ]);
    }

    public function sendVerifyMailCode(Request $request)
    {
        $code = '';
        $keys = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        for($i=0; $i < 55; $i++) {
            $code .= $keys[array_rand($keys)];
        }
        $details = [
            'link'=>env('CLIENT_URL').'/activation/'.$code,
        ];
        $start_date = date('Y-m-d H:i:s');
        $expire_date = date('Y-m-d H:i:s', strtotime('now +5 minute'));
        Mail::to($request->email)->send(new VerifyEmail($details));
        VerifyCode::create([
            'user_id'=>Auth()->user()->id,
            'code' => $code,
            'email'=>$request->email,
            'start_date' => $start_date,
            'expire_date' => $expire_date,
            'type'=>'0',
        ]);
    }

    public function verifyEmail(Request $request)
    {   
        $request->validate([
            'code'=>'required|max:55,min:55',
        ]);
        $now = date('Y-m-d H:i:s');
        $verifyCode = $request->code;
        $code = VerifyCode::where('code',$verifyCode)->where('email',Auth::user()->email)->where('user_id',Auth::user()->id)->where('start_date','<',$now)->where('expire_date','>',$now)->first();
        if($code){
            User::whereId(Auth::user()->id)->first()->update([
                'isEmailVerified' => '1',
                'email_verified_at' => $now,
            ]);
            return response()->json(['Email Verified']);
        }else{
            return response()->json([],401);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentPassword'=>'required',
            'password'=>'required|confirmed',
        ]);

        if($request->currentPassword !== Auth::user()->password){
            return response()->json([
                'message'=>'The given data was invalid.',
                'errors'=>[
                    'currentPassword'=>[
                        "Your current password is invalid.",
                    ],
                ],
            ],422);   
        }

        if($request->currentPassword == $request->password){
            return response()->json([
                'message'=>'The given data was invalid.',
                'errors'=>[
                    'currentPassword'=>[
                        "New password cannot be same with old password.",
                    ],
                ],
            ],422);
        }
        
        User::whereId(Auth::user()->id)->first()->update([
            'password'=>$request->password,
        ]);
        
    }
}
