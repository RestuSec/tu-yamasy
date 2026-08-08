<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::latest()->paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa',
            'nama' => 'required',
            'kelas' => 'required',
            'tahun_ajaran' => 'required',
            'nama_ortu' => 'required',
            'nama_ibu' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        Siswa::create($request->all());
        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis,'.$siswa->id,
            'nama' => 'required',
            'kelas' => 'required',
            'tahun_ajaran' => 'required',
            'nama_ortu' => 'required',
            'nama_ibu' => 'nullable',
            'no_hp' => 'nullable',
        ]);

        $siswa->update($request->all());
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diupdate!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus!');
    }
}