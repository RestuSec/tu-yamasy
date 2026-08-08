<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $siswaId = Session::get('ortu_siswa_id');

        if (!$siswaId) {
            return redirect()->route('ortu.login');
        }

        $siswa = Siswa::find($siswaId);
        $tagihan = $siswa->tagihan()->with('pembayaran')->latest()->get();
        $pengaturan = Pengaturan::first();

        return view('ortu.dashboard', compact('siswa', 'tagihan', 'pengaturan'));
    }
}