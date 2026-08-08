<x-layout title="Input Pembayaran - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Input Pembayaran Tunai</h1>
        <a href="{{ route('admin.pembayaran.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
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

        <form method="POST" action="{{ route('admin.pembayaran.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tagihan Siswa</label>
                    <select name="tagihan_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih Tagihan --</option>
                        @foreach($tagihan as $t)
                            <option value="{{ $t->id }}" {{ old('tagihan_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->siswa->nama }} - {{ $t->jenis }} (Rp {{ number_format($t->nominal, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                    <select name="metode" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih Metode --</option>
                        <option value="tunai" {{ old('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="qris" {{ old('metode') == 'qris' ? 'selected' : '' }}>QRIS</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bukti Pembayaran (opsional)</label>
                    <input type="file" name="bukti" accept="image/*"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maks 2MB</p>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">
                    Simpan Pembayaran
                </button>
            </div>
        </form>
    </div>
</x-layout>