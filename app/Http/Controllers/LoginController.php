<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){
        return view('admin');
    }

    public function check(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'user_type_id' => 1])) {

            return redirect()->intended('admin');
        }

        return redirect('admin/login')->with('fail','Incorrect credentials!');
    }

    public function logout(){

        Auth::logout();
        
        return redirect('/');
    }
}
