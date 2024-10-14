<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Gunakan Auth::attempt untuk melakukan login
        if (Auth::attempt($credentials)) {
            // Jika berhasil login, redirect ke halaman home
            return redirect()->route('movies.index')->with('success', 'Berhasil login');
        } else {
            // Jika gagal login, flash error message
            Session::flash('error', 'Email atau Password salah');
            return redirect()->route('login')->withInput(); // Kembali ke form login dengan input
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        //
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input dari form
    $request->validate([
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8', // memastikan password dan password_confirmation sama
        'name' => 'required|string|max:255',
    ]);

    // Menyimpan user ke database
    User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'name' => $request->name,
        'role' => 'user', // Role otomatis 'user'
    ]);

    // Redirect setelah registrasi berhasil
    return redirect()->route('login')->with('success', 'Registration successful!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
