<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function handelregister(Request $request){
   $request->validate([
            'name'=>'required | string',
            'email'=> 'required| email |unique:users',
            'password'=> 'required | string |min:8',
            
        ]);

        $name=$request->name;
        $email=$request->email;
        $password=$request->password;

       $userdata= User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
            'role' => $request->role,
        ]);

        Auth::login($userdata);

        return redirect(route('main.homepage'));
    }

    public function handellogin(Request $request){
        $request->validate([
            'email'=> 'required| email',
            'password'=> 'required | string |min:8',
        ]);  

        $cord = $request->only('email', 'password');

        if(Auth::attempt($cord)){
            return redirect(route('main.homepage'));
        }else{
            return view('auth.login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(route('auth.login'));
    }

    }

