<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function store() {
        //validation
        $formData = request()->validate([
            'name' => 'required|max:255|min:3',
            'username' => ['required', 'max:255', 'min:3', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:8',
        ]);

        $user = User::create($formData);

        Auth::login($user);

        // session()->flash('success', 'Welcome Dear, ' . $user->name);
        return redirect('/')->with('success', 'Welcome Dear, ' . $user->name);
    }

    public function login() {
        return view('auth.login');
    }

    public function post_login() {
        //validation
        $formData = request()->validate([
            'email' => ['required', 'email', 'max:255', Rule::exists('users', 'email')],
            'password' => 'required|min:8|max:255',
        ], [
            'email.required' => 'Email is required',
            'password.min' => 'Password must be more than 8 characters',
        ]);
        //auth attempt
        if(Auth::attempt($formData)) {
            //if user credentials correct -> redirect home
            return redirect('/')->with('success', 'Welcome back');
        } else {
            //if user credentials fail -> redirect back to form with error
            return redirect()->back()->withErrors([
                'email' => 'User Credential Wrong',
            ]);
        }
    }

    public function logout() {
        Auth::logout();

        return redirect('/')->with('success', 'Good Bye');
    }
}
