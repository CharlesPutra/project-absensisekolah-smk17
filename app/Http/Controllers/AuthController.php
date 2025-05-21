<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Showlogin() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('name','password'))) {
            return redirect()->route('home');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
