<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['tagihan.siswa'])->latest()->paginate(10);
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $tagihan = Tagihan::with('siswa')->where('status', 'belum_lunas')->get();
        return view('admin.pembayaran.create', compact('tagihan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tagihan_id' => 'required|exists:tagihan,id',
            'metode' => 'required|in:tunai,qris',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $data = [
            'tagihan_id' => $request->tagihan_id,
            'metode' => $request->metode,
            'tgl_bayar' => now(),
        ];

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti', 'public');
        }

        $data['status'] = $request->metode == 'tunai' ? 'verified' : 'pending';

        $tagihan = Tagihan::findOrFail($request->tagihan_id);
        Pembayaran::create($data);

        if ($request->metode == 'tunai') {
            $tagihan->update(['status' => 'lunas']);
        }

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dicatat!');
    }

    public function verifikasi(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'verified',
            'verified_by' => auth()->id(),
        ]);

        if ($pembayaran->tagihan) {
            $pembayaran->tagihan->update(['status' => 'lunas']);
        }

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diverifikasi!');
    }

    public function tolak(Pembayaran $pembayaran)
    {
        $pembayaran->update(['status' => 'rejected']);
        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran ditolak!');
    }
}