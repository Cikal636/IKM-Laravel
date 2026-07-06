<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $pegawai = Pegawai::where('username', $request->username)->first();

        if (!$pegawai) {
            return back()
                ->with('error', 'Username tidak ditemukan!')
                ->withInput();
        }

        if ($pegawai->password != $request->password) {
            return back()
                ->with('error', 'Password salah!')
                ->withInput();
        }

        $request->session()->put([
            'id_pegawai' => $pegawai->id_pegawai,
            'nama_pegawai' => $pegawai->nama_pegawai,
            'username' => $pegawai->username,
        ]);

        return redirect('/dashboard');
    }
    public function logout(\Illuminate\Http\Request $request)
{
    // 1. Hapus session manual jika kamu pakai session custom (seperti nama_pegawai)
    session()->forget('nama_pegawai');
    
    // 2. Jika kamu pakai Auth bawaan Laravel, hapus tanda komentar di bawah ini:
    // auth()->logout(); 

    // 3. Bersihkan dan amankan session browser
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 4. Tendang balik ke halaman login
    return redirect('/login');
}
}