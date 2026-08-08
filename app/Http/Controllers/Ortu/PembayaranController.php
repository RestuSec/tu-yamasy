<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PembayaranController extends Controller
{
    public function create($tagihan)
    {
        $tagihan = Tagihan::with('siswa')->findOrFail($tagihan);
        $siswaId = Session::get('ortu_siswa_id');

        if ($tagihan->siswa_id != $siswaId) {
            return redirect()->route('ortu.dashboard');
        }

        $pengaturan = Pengaturan::first();

        return view('ortu.pembayaran', compact('tagihan', 'pengaturan'));
    }

    public function store(Request $request, $tagihan)
    {
        $request->validate([
            'nama_pengirim' => 'required',
            'bank' => 'required',
            'bukti' => 'required|image|max:5120',
        ]);

        $tagihan = Tagihan::findOrFail($tagihan);
        $siswaId = Session::get('ortu_siswa_id');

        if ($tagihan->siswa_id != $siswaId) {
            return redirect()->route('ortu.dashboard');
        }

        if ($tagihan->status === 'lunas' || $tagihan->pembayaran()->where('status', 'pending')->exists()) {
            return redirect()->route('ortu.dashboard')->with('error', 'Tagihan ini sudah dibayar atau masih menunggu verifikasi.');
        }

        $buktiPath = $request->file('bukti')->store('bukti', 'public');

        Pembayaran::create([
            'tagihan_id' => $tagihan->id,
            'metode' => 'qris',
            'bukti' => $buktiPath,
            'status' => 'pending',
            'tgl_bayar' => now(),
        ]);

        return redirect()->route('ortu.dashboard')->with('success', 'Bukti pembayaran berhasil dikirim! Menunggu verifikasi admin.');
    }

    public function mandiri(Request $request)
    {
        $request->validate([
            'jenis_bayar' => 'required',
            'jenis_bayar_lainnya' => 'nullable|required_if:jenis_bayar,Lainnya',
            'nama_pengirim' => 'required',
            'nominal' => 'required|regex:/^[0-9.]+$/',
            'bank' => 'required',
            'bukti' => 'nullable|image|max:5120',
        ]);

        $siswaId = Session::get('ortu_siswa_id');
        $jenis = $request->jenis_bayar == 'Lainnya' ? $request->jenis_bayar_lainnya : $request->jenis_bayar;

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti', 'public');
        }

        $tagihan = Tagihan::create([
            'siswa_id' => $siswaId,
            'jenis' => $jenis,
            'nominal' => (int) str_replace('.', '', $request->nominal),
            'tahun_ajaran' => date('Y') . '/' . (date('Y') + 1),
            'status' => 'belum_lunas',
        ]);

        Pembayaran::create([
            'tagihan_id' => $tagihan->id,
            'metode' => 'qris',
            'bukti' => $buktiPath,
            'status' => 'pending',
            'tgl_bayar' => now(),
        ]);

        return redirect()->route('ortu.dashboard')->with('success', 'Bukti pembayaran berhasil dikirim! Menunggu verifikasi admin.');
    }
}