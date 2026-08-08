<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - TU YAMASY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-green-700 text-white px-6 py-4 flex justify-between items-center shadow">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-yamasy.png') }}" class="w-11 h-11 object-contain">
            <span class="font-bold text-lg">TU YAMASY</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('ortu.dashboard') }}" class="bg-white text-green-700 px-3 py-1 rounded text-sm font-semibold">← Kembali</a>
        </div>
    </nav>

    <div class="max-w-lg mx-auto mt-8 px-4">

        <!-- Info Tagihan -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-lg font-bold text-green-700 mb-3">Detail Tagihan</h2>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div>
                    <p class="text-gray-500">Nama Siswa</p>
                    <p class="font-semibold">{{ $tagihan->siswa->nama }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Jenis</p>
                    <p class="font-semibold">{{ $tagihan->jenis }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Nominal</p>
                    <p class="font-bold text-green-700 text-lg">Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Bulan</p>
                    <p class="font-semibold">{{ $tagihan->bulan ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Info Transfer -->
        @if($pengaturan)
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <h3 class="font-bold text-green-700 mb-3">📋 Info Transfer</h3>
            <div class="bg-white rounded p-3 text-sm mb-3">
                <p class="text-gray-500 mb-1">Bank</p>
                <p class="font-bold text-lg">{{ strtoupper($pengaturan->nama_bank) }}</p>
                <p class="text-gray-500 mt-2 mb-1">No Rekening</p>
                <div class="flex items-center gap-2">
                    <p class="font-bold text-xl text-green-700" id="norek">{{ $pengaturan->no_rekening }}</p>
                    <button onclick="copyNorek()" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700" id="copyBtn">
                        📋 Salin
                    </button>
                </div>
                <p class="text-gray-500 mt-2 mb-1">Atas Nama</p>
                <p class="font-semibold">{{ $pengaturan->atas_nama }}</p>
            </div>

            @if($pengaturan->qris_image)
            <div class="bg-white rounded p-3 text-center">
                <p class="text-sm font-semibold text-gray-700 mb-2">atau scan QR Code QRIS:</p>
                <img src="{{ asset('storage/'.$pengaturan->qris_image) }}" class="w-48 h-48 object-contain mx-auto">
                <a href="{{ asset('storage/'.$pengaturan->qris_image) }}" download="QRIS-YAMASY.png"
                    class="mt-2 inline-block bg-blue-600 text-white px-4 py-1 rounded text-xs hover:bg-blue-700">
                    ⬇️ Download QR Code
                </a>
            </div>
            @endif

            <p class="text-xs text-gray-500 mt-2">* Setelah transfer, upload bukti pembayaran di bawah</p>
        </div>
        @endif

        <!-- Form Upload Bukti -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Upload Bukti Pembayaran</h2>

            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('ortu.pembayaran.store', $tagihan->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pembayaran Untuk</label>
                    <select name="jenis_bayar" id="jenis_bayar" onchange="cekLainnya()"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach(['SPP','DSP','Seragam','Buku','Pendaftaran','Kegiatan','Lainnya'] as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="jenis_bayar_lainnya" id="jenis_bayar_lainnya"
                        class="w-full border rounded px-3 py-2 mt-2 focus:outline-none focus:ring-2 focus:ring-green-500 hidden"
                        placeholder="Tulis jenis pembayaran...">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengirim</label>
                    <input type="text" name="nama_pengirim" value="{{ old('nama_pengirim') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Nama sesuai rekening pengirim" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bank Pengirim</label>
                    <select name="bank" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Bank --</option>
                        @foreach(['BRI','BCA','BNI','Mandiri','BSI','DANA','OVO','GoPay','Lainnya'] as $b)
                            <option value="{{ $b }}">{{ $b }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti Transfer</label>
                    <input type="file" name="bukti" accept="image/*"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="text-xs text-gray-400 mt-1">Upload foto struk atau screenshot transfer</p>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded hover:bg-green-700 font-semibold">
                    Kirim Bukti Pembayaran
                </button>
            </form>
        </div>

        <!-- Support -->
        @if($pengaturan)
        <div class="bg-white rounded-lg shadow p-4 text-center text-sm text-gray-500 mb-6">
            Butuh bantuan? Hubungi: <span class="font-semibold text-green-700">📞 {{ $pengaturan->nama_kontak }} - {{ $pengaturan->no_telepon }}</span>
        </div>
        @endif

    </div>

    <script>
    function copyNorek() {
        const norek = document.getElementById('norek').innerText;
        navigator.clipboard.writeText(norek).then(function() {
            const btn = document.getElementById('copyBtn');
            btn.innerText = '✅ Tersalin!';
            btn.classList.remove('bg-green-600');
            btn.classList.add('bg-gray-500');
            setTimeout(() => {
                btn.innerText = '📋 Salin';
                btn.classList.remove('bg-gray-500');
                btn.classList.add('bg-green-600');
            }, 2000);
        });
    }

    function cekLainnya() {
        const select = document.getElementById('jenis_bayar');
        const input = document.getElementById('jenis_bayar_lainnya');
        if (select.value === 'Lainnya') {
            input.classList.remove('hidden');
            input.required = true;
        } else {
            input.classList.add('hidden');
            input.required = false;
        }
    }
    </script>

</body>
</html>