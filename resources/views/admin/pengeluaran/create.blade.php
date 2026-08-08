<x-layout title="Tambah Pengeluaran - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Tambah Pengeluaran</h1>
        <a href="{{ route('admin.pengeluaran.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
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

        <form id="formPengeluaran" method="POST" action="{{ route('admin.pengeluaran.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Keterangan pengeluaran">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(['Operasional','ATK','Gaji','Kegiatan','Perawatan','Lainnya'] as $kat)
                            <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nominal</label>
                    <input type="text" name="nominal" id="nominal" value="{{ old('nominal') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 500.000">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tgl_pengeluaran" value="{{ old('tgl_pengeluaran') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">
                    Simpan Pengeluaran
                </button>
            </div>
        </form>
    </div>

    <script>
    window.addEventListener('load', function() {
        const nominal = document.getElementById('nominal');
        nominal.addEventListener('input', function(e) {
            let val = e.target.value.replace(/\./g, '').replace(/\D/g, '');
            e.target.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        });
        document.getElementById('formPengeluaran').addEventListener('submit', function() {
            nominal.value = nominal.value.replace(/\./g, '');
        });
    });
    </script>
</x-layout>