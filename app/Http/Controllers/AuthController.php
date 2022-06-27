<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengguna' => 'required|unique:users,nama_pengguna',
            'nama_toko' => 'required',
            'pemilik' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8'
        ], [
            'nama_pengguna.required' => 'Nama pengguna masih kosong',
            'nama_pengguna.unique' => 'Nama pengguna telah terdaftar',
            'nama_toko.required' => 'Nama toko masih kosong',
            'pemilik.required' => 'Pemilik masih kosong',
            'alamat.required' => 'Alamat masih kosong',
            'no_telepon.required' => 'Nomor telepon masih kosong',
            'password.required' => 'Kata sandi masih kosong',
            'password.min' => 'Kata sandi kurang dari 8 karakter',
            'confirm_password.required' => 'Konfirmasi kata sandi masih kosong',
            'confirm_password.min' => 'Konfirmasi kata sandi kurang dari 8 karakter',
            'confirm_password.same' => 'Konfirmasi kata sandi tidak sesuai',
        ]);
        $validated['password'] = Hash::make($request->password);
        User::create($validated);
        return redirect('/login')->with('berhasil', 'Akun baru berhasil ditambahkan!');
    }
    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'nama_pengguna' => 'required',
            'password' => 'required',
        ], [
            'nama_pengguna.required' => 'Nama pengguna masih kosong',
            'password.required' => 'Kata sandi masih kosong',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin')->with('berhasil', 'Selamat datang ' . auth()->user()->pemilik);
        }
        return back()->with('gagal', 'Gagal masuk, mohon coba lagi!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
