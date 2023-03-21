<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function getLogin()
    {
        return view('Auth.Page.Login');
    }

    
    public function postLogin(Request $request) {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
    
        $user = User::where('username', $request->username)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
    
            $request->session()->regenerate();
    
            if ($user->role->name === 'Admin') {
                return redirect()->route('admin.index')->with('success', 'Login such as an Administrator Successfully!');
            } elseif($user->role->name === 'Staff') {
                return redirect()->route('staff.index')->with('success', 'Login such as a Staff Successfully!');
            } else {
                return redirect()->route('trainer.index')->with('success', 'Login such as a Trainer Successfully!');
            }
        }
    
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    
    public function postLogout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

}
