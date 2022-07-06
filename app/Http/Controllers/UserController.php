<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        
        $validatedCredential = $request->validate($rules);
        if(Auth::attempt($validatedCredential)){
            $request->session()->regenerate();
            return redirect('/');
        }
        // dd($validatedCredential);
        return back()->with('login_fail', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt($validatedData['password']); 
        // dd($validatedData);
        User::create($validatedData);

        return redirect('/login')->with('register_success', 'Account has been registered! Please Login!');
    }

}
