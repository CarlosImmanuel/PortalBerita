<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function register() {
        return view('Auth/register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            "email" => 'email:dns|unique:users',
            "password" => 'min:8|max:225'

        ]);

        // Hitung jumlah user di database
        $userCount = User::count();

        // Tentukan role berdasarkan jumlah user
        $role = $userCount === 0 ? 'admin' : 'user';

        // Simpan user dengan role dan password yang sudah di-hash
        User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $role, // pastikan field 'role' ada di tabel users
        ]);

        // $request->session()->flash('success', 'Registration successfull! Please login');
        session()->flash('success', 'Registration successful! Please login');

        return redirect('/login');

    }

    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::whereEmail($googleUser->email)->first();
        if(!$user){
            $user = User::create(['username' => $googleUser->name, 'email' => $googleUser->email, 'password' => bcrypt(uniqid()), 'status' => 'active' ]);
        }

        Auth::login($user);
        if($user->role == 'admin') return redirect('/Dashboard');
        return redirect('/news');
    }
}
