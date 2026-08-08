<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first() ?? new Pengaturan();
        return view('admin.pengaturan', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'atas_nama' => 'required',
            'no_telepon' => 'required',
            'nama_kontak' => 'required',
            'qris_image' => 'nullable|image|max:2048',
        ]);

        $pengaturan = Pengaturan::first() ?? new Pengaturan();

        $data = $request->except('qris_image');

        if ($request->hasFile('qris_image')) {
            $data['qris_image'] = $request->file('qris_image')->store('qris', 'public');
        }

        $pengaturan->fill($data)->save();

        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}