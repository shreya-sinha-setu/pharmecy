<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordManager extends Controller
{
    public function forgetPassword(){
        return view('auth.forgetpassword');
   }

   public function forgetPasswordPost(Request $request){

       $request->validate([
       'email'=>"required|email|exists:users",
       ]);

       $token=Str::random(64);

       DB::table('password_resets')->insert([
       'email'=>$request->email,
       'token'=>$token,
       'created_at'=>Carbon::now(),
       ]);

       Mail::send('admin.pages.email.forgetpassword',['token'=>$token],function ($message) use ($request){
       $message->to($request->email);
       $message->subject('Reset Password');
       });

       return redirect()->to(route('forget.password.show'))->with('Success','We have send an email to reset password.');
       
   }

   public function resetPassword($token){
       return view('auth.newpassword',compact('token'));
   }

   public function resetPasswordPost(Request $request){
               $request->validate([
                 "email"=>"required|email|exists:users",
                 "password"=>"required|string|min:6|confirmed",
                 "password_confirmation"=>"required"
               ]);

             $updatePassword = DB::table('password_resets') ->where([
                'email'=>$request->email,
                'token'=>$request->token,
             ])->first();
             
             if(!$updatePassword){
               return redirect()->to(route('reset.password'))->with('error','Invalid');
             }

             User::where('email',$request->email)->update([
               'password'=>Hash::make($request->password),
             ]);


             DB::table('password_resets')->where(['email'=>$request->email]);
             return redirect()->to(route('/'))->with('Success','Password  Reset Succesfully...');
   }

}
