<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admins;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $request ->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $admin = Admins::where('email', $request->email)->first();
        if($admin && Hash::check($request->password, $admin->password)){
            Auth::login($admin);
            return redirect()->intended('dashboard');
        }else{
            return back()->with('error', 'Bad credentials');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function register(Request $request){
        $request -> validate([
            'username' =>'required',
            'email' =>'required|email|unique:tbl_admins',
            'password' => 'required|min:8|confirmed',
            'first_name' =>'required',
            'last_name' =>'required'
        ]);
        $admin = new Admins();
        $admin->username = $request->username;
        $admin->email = $request->email;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $admin->password =  Hash::make($request->password);
        $admin->save();
        return redirect()->route('login')->with('success', 'Registration successful');
    }
}
