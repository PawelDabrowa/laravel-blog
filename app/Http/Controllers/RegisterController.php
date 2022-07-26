<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create() {
        return view('register.create');
    }

    public function store() {
        $attributes = request()->validate([
            'name' => 'required|max:25|min:3',
            'username' => 'required|max:255|min:3|unique:users,username',
            'email' => 'required|email|max:255|min:5|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        User::create($attributes);

        return redirect('/')->with('success', 'Your account has been created');
    }
}
