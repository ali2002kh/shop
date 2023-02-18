<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function login(Request $request) {

        $request->validate([
            'emailOrNumber' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->get('emailOrNumber'))->first();
        if ($user == null) {
            $user = User::where('number', $request->get('emailOrNumber'))->first();
            if ($user == null) {
                return abort(421, 'Invalid email or number');
            }
        }

        if (Hash::check($request->get('password'), $user->password)) {
            Auth::login($user);
            return abort(200);
        }

        return abort(421, 'Invalid password');
    }

    public function signup(Request $request) {

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

        $user = Auth::user();
        Auth::logout();
        return new UserResource($user);
    }
}
