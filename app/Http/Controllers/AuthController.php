<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view("login");
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email"=> ["required","email"],
            "password"=> ["required"],
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        
        Session::flash('status','failed');
        Session::flash('message','Wrong Email/Password!');
        return redirect('/login');
    }

    public function logout(Request $request)    
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');

    }
}
