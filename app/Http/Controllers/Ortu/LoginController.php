<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('ortu.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama_ibu' => 'required',
        ]);

        $siswa = Siswa::where('nis', $request->nis)
            ->whereRaw('LOWER(nama_ibu) = ?', [strtolower($request->nama_ibu)])
            ->first();

        if (!$siswa) {
            return back()->withErrors([
                'nis' => 'NIS atau Nama Ibu tidak ditemukan.',
            ]);
        }

        Session::put('ortu_siswa_id', $siswa->id);
        Session::put('ortu_nis', $siswa->nis);
        Session::put('ortu_nama', $siswa->nama);

        return redirect()->route('ortu.dashboard');
    }

    public function logout()
    {
        Session::forget(['ortu_siswa_id', 'ortu_nis', 'ortu_nama']);
        return redirect()->route('ortu.login');
    }
}