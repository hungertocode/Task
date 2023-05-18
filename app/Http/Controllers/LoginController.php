<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware('guest')->except('logout');

    }
   
    public function get(Request $request)
    {
        // if(Auth::user())
        // {
        //     return redirect('events.index');
        // }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Check if remember me checkbox is checked
        
        // return $credentials;
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('events.index');
        }
        return redirect()->back()->with(['error' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
