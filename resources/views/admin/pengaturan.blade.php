<x-layout title="Pengaturan - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Pengaturan Pembayaran</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                    <input type="text" name="nama_bank" value="{{ old('nama_bank', $pengaturan->nama_bank) }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: BRI">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No Rekening</label>
                    <input type="text" name="no_rekening" value="{{ old('no_rekening', $pengaturan->no_rekening) }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 1234-5678-9012">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Atas Nama</label>
                    <input type="text" name="atas_nama" value="{{ old('atas_nama', $pengaturan->atas_nama) }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nama pemilik rekening">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak Support</label>
                    <input type="text" name="nama_kontak" value="{{ old('nama_kontak', $pengaturan->nama_kontak) }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: Restu">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No Telepon Support</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $pengaturan->no_telepon) }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 085888796799">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">QR Code QRIS</label>
                    @if($pengaturan->qris_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$pengaturan->qris_image) }}" class="w-40 h-40 object-contain border rounded">
                            <p class="text-xs text-gray-400 mt-1">QR Code saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="qris_image" accept="image/*"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="text-xs text-gray-400 mt-1">Upload foto QR Code QRIS</p>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</x-layout>