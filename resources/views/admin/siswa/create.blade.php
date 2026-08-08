<x-layout title="Tambah Siswa - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Tambah Siswa</h1>
        <a href="{{ route('admin.siswa.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            ← Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.siswa.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                    <input type="text" name="nis" value="{{ old('nis') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nomor Induk Siswa">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nama siswa">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 7A, 8B, 9C">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 2025/2026">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua</label>
                    <input type="text" name="nama_ortu" value="{{ old('nama_ortu') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nama orang tua/wali">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nama ibu kandung siswa">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nomor HP orang tua">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">
                    Simpan Data Siswa
                </button>
            </div>
        </form>
    </div>
</x-layout>