<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class RegisterController extends Controller
{
    public function register() {
        return view('Auth/register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "email" => 'email:dns|unique:users',
            "password" => 'min:8|max:225'

        ]);

        User::create($validatedData);

        // $request->session()->flash('success', 'Registration successfull! Please login');
        session()->flash('success', 'Registration successful! Please login');

        return redirect('/login');

    }
}
