<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Ambil semua user dari database
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'username' => [
            'required',
            'min:4',
            'max:20',
            'unique:users,username',
            'regex:/^[a-zA-Z0-9_]+$/',
        ],
        'email' => [
            'required',
            'email',
            'unique:users,email',
            'regex:/^[\w\.-]+@(gmail\.com|yahoo\.com|outlook\.com)$/i',
        ],
        'role' => 'required|in:admin,user',
        'password' => 'required|min:8',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Akun berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
        'email' => [
            'required',
            'email',
            'unique:users,email,' . $user->id,
            'regex:/^[\w\.-]+@(gmail\.com|yahoo\.com|outlook\.com)$/i',
        ],
        'role' => 'required|in:admin,user',
    ]);

        $user->update([
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->forceDelete(); // menghapus total dari database
        return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus.');
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'banned';
        $user->save();

        return back()->with('success', 'Akun berhasil dibekukan.');
    }

    public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return back()->with('success', 'Akun berhasil diaktifkan kembali.');
    }
}
