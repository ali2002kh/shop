<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup_page()
    {
        return view('client.pages.auth.signup');
    }

    public function login_page()
    {
        return view('client.pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        
        $user = User::where('email', $request->get('emailOrNumber'))->first();
        
        if ($user == null) {
            $user = User::where('number', $request->get('emailOrNumber'))->first();
            if ($user == null) {
                // return redirect()->route('login_page')
                // ->withErrors(['msg' => 'email or number is invalid'])->withInput();
            }
        }

        if (Hash::check($request->get('password'), $user->password)) {
            Auth::login($user);
            // return redirect('home');
        }
        // return redirect()->route('login_page')
        // ->withErrors(['msg' => 'password is invalid'])->withInput();
    }

    public function signup(Request $request)
    {
        $request->validate([
            'number' => 'required|regex:/(09)[0-9]{9}/|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password|min:8',
        ]);

        $user = new User([
            'email' => $request->get('email'),
            'number' => $request->get('number'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user->save();
        Auth::login($user);
    }

    public function logout() {

        Auth::logout();
        return 'logged out';
    }
}
