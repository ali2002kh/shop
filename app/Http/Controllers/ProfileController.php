<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        $categories = Category::all();

        return view('client.pages.profile.show', compact('user', 'categories'));
    }

    public function edit()
    {
        $user = auth()->user();

       return view('client.pages.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'number' => ['regex:/(09)[0-9]{9}/', Rule::unique('users')->ignore($user->id)],
            'email' => [Rule::unique('users')->ignore($user->id)],
            'password' => 'min:8|nullable',
            'confirm_password' => 'same:password',
        ]);

        if (!is_null($request->get('fname'))) {
            $user->fname = $request->get('fname');
        }

        if (!is_null($request->get('lname'))) {
            $user->lname = $request->get('lname');
        }

        if (!is_null($request->get('number'))) {
            $user->number = $request->get('number');
        }

        if (!is_null($request->get('email'))) {
            $user->email = $request->get('email');
        }

        if (!is_null($request->get('password'))) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();



       return redirect()->route('profile.show');
    }

}
