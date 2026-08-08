<x-layout title="Edit Tagihan - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Edit Tagihan</h1>
        <a href="{{ route('admin.tagihan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
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

        <form id="formTagihan" method="POST" action="{{ route('admin.tagihan.update', $tagihan->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Siswa</label>
                    <select name="siswa_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}" {{ $tagihan->siswa_id == $s->id ? 'selected' : '' }}>
                                {{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Tagihan</label>
                    <select name="jenis" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih Jenis --</option>
                        @foreach(['SPP','DSP','Seragam','Buku','Kegiatan','Lainnya'] as $jenis)
                            <option value="{{ $jenis }}" {{ $tagihan->jenis == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nominal</label>
                    <input type="text" name="nominal" id="nominal"
                        value="{{ number_format(old('nominal', $tagihan->nominal), 0, ',', '.') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 500.000">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                    <select name="bulan" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                            <option value="{{ $bulan }}" {{ $tagihan->bulan == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                        @endforeach
                    </select>
                </div>
               <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', $tagihan->tahun_ajaran) }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $tagihan->tanggal) }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div>
                    
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="belum_lunas" {{ $tagihan->status == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="lunas" {{ $tagihan->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">
                    Update Tagihan
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
        document.getElementById('formTagihan').addEventListener('submit', function() {
            nominal.value = nominal.value.replace(/\./g, '');
        });
    });
    </script>
</x-layout>