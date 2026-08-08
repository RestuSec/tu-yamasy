<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::latest()->paginate(10);
        return view('admin.pengeluaran.index', compact('pengeluaran'));
    }

    public function create()
    {
        return view('admin.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'nominal' => 'required|numeric',
            'kategori' => 'nullable',
            'tgl_pengeluaran' => 'required',
        ]);

        $data = $request->all();
        $data['admin_id'] = auth()->id();

        Pengeluaran::create($data);
        return redirect()->route('admin.pengeluaran.index')->with('success', 'Pengeluaran berhasil dicatat!');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('admin.pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus!');
    }
}