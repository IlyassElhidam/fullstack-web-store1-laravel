<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Sig_LogController extends Controller
{
  //function to get bsignup in our database
    public function Signup(Request $request){
     $user_data= $request->post();
    $is_created= User::create([
        'name'=>  strip_tags($user_data['name']),
        'phone'=>  strip_tags($user_data['phone']),
        'email'=>  strip_tags($user_data['email']),
        'password'=>  Hash::make(strip_tags($user_data['password'])),
        'user_type'=>  strip_tags($user_data['option']),
     ]);
     //select user or admin data
     if($is_created){
      $user_infos1= User::where('email',$user_data['email'])->first();
      return [
         'user_infos'=>$user_infos1,
          'status'=>'succes',
      ];
     }
   else{
     return [
      'status'=>'failed',
      ];
   }
 }
    //function to get login in our databse
    public function Login(Request $request){
      $user_login= $request->post();
      $cridentials= [
        'email'=>$user_login['email'],
        'password'=>$user_login['password'],
      ];
      $is_exist= Auth::attempt($cridentials);
      if($is_exist){
         $user_data=User::where('email', $user_login['email'] )->first();
         return [
             'user_infos'=>$user_data,
              'status'=>'succes',
            ];
      }
    else{
      return [
            'status'=>'failed',
         ];
    }
    }
}
