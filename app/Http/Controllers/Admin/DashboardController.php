<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalPemasukan = Tagihan::where('status', 'lunas')->sum('nominal');
        $totalPengeluaran = Pengeluaran::sum('nominal');
        $pembayaranPending = Pembayaran::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalPemasukan',
            'totalPengeluaran',
            'pembayaranPending'
        ));
    }
}