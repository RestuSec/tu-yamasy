<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::with('siswa')->latest()->paginate(10);
        return view('admin.tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('admin.tagihan.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'jenis' => 'required',
            'nominal' => 'required|numeric',
            'bulan' => 'nullable',
            'tahun_ajaran' => 'required',
        ]);

        Tagihan::create($request->all());
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil ditambahkan!');
    }

    public function edit(Tagihan $tagihan)
    {
        $siswa = Siswa::all();
        return view('admin.tagihan.edit', compact('tagihan', 'siswa'));
    }

    public function update(Request $request, Tagihan $tagihan)
    {
        $request->validate([
            'siswa_id' => 'required',
            'jenis' => 'required',
            'nominal' => 'required|numeric',
            'tahun_ajaran' => 'required',
        ]);

        $tagihan->update($request->all());
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil diupdate!');
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil dihapus!');
    }
}