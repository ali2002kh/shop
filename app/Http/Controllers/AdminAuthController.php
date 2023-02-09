<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller {

    public function login_page()
    {
        return view('admin.pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        
        $user = User::where('email', $request->get('email-or-number'))->first();
        
        if ($user == null) {
            $user = User::where('number', $request->get('email-or-number'))->first();
            if ($user == null) {
                return redirect()->route('login_page')
                ->withErrors(['msg' => 'email or number is invalid'])->withInput();
            }
        }

        if (Hash::check($request->get('password'), $user->password)) {
            Auth::login($user);
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
            
        }
        return redirect()->route('admin.login_page')
        ->withErrors(['msg' => 'password is invalid'])->withInput();
    }
}
