<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Siswa - TU YAMASY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-green-700 text-white px-6 py-4 flex justify-between items-center shadow">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-yamasy.png') }}" class="w-11 h-11 object-contain">
            <span class="font-bold text-lg">TU YAMASY</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm">{{ $siswa->nama }}</span>
            <form method="POST" action="{{ route('ortu.logout') }}">
                @csrf
                <button class="bg-white text-green-700 px-3 py-1 rounded text-sm font-semibold">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto mt-8 px-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow p-6 mb-6 text-center">
            <h1 class="text-2xl font-bold text-green-700">Selamat Datang!</h1>
            <p class="text-gray-500 mt-1">{{ $siswa->nama }} - Kelas {{ $siswa->kelas }}</p>
        </div>

        <div class="grid grid-cols-3 gap-2 sm:gap-4 mb-6">
            <button onclick="showMenu('data-siswa')" class="bg-white rounded-lg shadow p-3 sm:p-6 flex flex-col items-center justify-center text-center hover:bg-green-50 hover:shadow-md transition cursor-pointer border-2 border-transparent hover:border-green-500 h-full">
                <div class="text-2xl sm:text-4xl mb-1 sm:mb-2">📋</div>
                <p class="font-semibold text-gray-700 text-[11px] sm:text-base leading-tight">Data Siswa</p>
            </button>
            <button onclick="showMenu('pembayaran')" class="bg-white rounded-lg shadow p-3 sm:p-6 flex flex-col items-center justify-center text-center hover:bg-green-50 hover:shadow-md transition cursor-pointer border-2 border-transparent hover:border-green-500 h-full relative">
                <div class="text-2xl sm:text-4xl mb-1 sm:mb-2">💳</div>
                <p class="font-semibold text-gray-700 text-[11px] sm:text-base leading-tight">Pembayaran</p>
                @php $belumLunas = $tagihan->where('status', 'belum_lunas')->count(); @endphp
                @if($belumLunas > 0)
                    <span class="bg-red-500 text-white text-[9px] sm:text-xs px-2 py-0.5 rounded-full mt-1 sm:mt-2">{{ $belumLunas }} tagihan</span>
                @endif
            </button>
            <button onclick="showMenu('riwayat')" class="bg-white rounded-lg shadow p-3 sm:p-6 flex flex-col items-center justify-center text-center hover:bg-green-50 hover:shadow-md transition cursor-pointer border-2 border-transparent hover:border-green-500 h-full">
                <div class="text-2xl sm:text-4xl mb-1 sm:mb-2">📜</div>
                <p class="font-semibold text-gray-700 text-[11px] sm:text-base leading-tight">Riwayat</p>
            </button>
        </div>

        <div id="data-siswa" class="hidden bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-lg font-bold text-green-700 mb-4">📋 Data Siswa</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><p class="text-gray-500">NIS</p><p class="font-semibold text-lg">{{ $siswa->nis }}</p></div>
                <div><p class="text-gray-500">Nama</p><p class="font-semibold text-lg">{{ $siswa->nama }}</p></div>
                <div><p class="text-gray-500">Kelas</p><p class="font-semibold text-lg">{{ $siswa->kelas }}</p></div>
                <div><p class="text-gray-500">Tahun Ajaran</p><p class="font-semibold text-lg">{{ $siswa->tahun_ajaran }}</p></div>
                <div><p class="text-gray-500">Nama Orang Tua</p><p class="font-semibold text-lg">{{ $siswa->nama_ortu }}</p></div>
                <div><p class="text-gray-500">No HP</p><p class="font-semibold text-lg">{{ $siswa->no_hp ?? '-' }}</p></div>
            </div>
        </div>

        <div id="pembayaran" class="hidden mb-6">
            @if($pengaturan)
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                <h3 class="font-bold text-green-700 mb-3">📋 Info Transfer</h3>
                <div class="bg-white rounded p-3 text-sm mb-3">
                    <p class="text-gray-500 mb-1">Bank</p>
                    <p class="font-bold text-lg">{{ strtoupper($pengaturan->nama_bank) }}</p>
                    <p class="text-gray-500 mt-2 mb-1">No Rekening</p>
                    <div class="flex items-center gap-2">
                        <p class="font-bold text-xl text-green-700" id="norek">{{ $pengaturan->no_rekening }}</p>
                        <button onclick="copyNorek()" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700" id="copyBtn">📋 Salin</button>
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
            </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden mb-4">
                <div class="p-4 bg-green-600">
                    <h2 class="text-lg font-bold text-white">💳 Tagihan</h2>
                </div>
                @forelse($tagihan as $t)
                <div class="p-4 border-b hover:bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold">{{ $t->jenis }}</p>
                            <p class="text-sm text-gray-500">{{ $t->bulan ?? '' }} {{ $t->tahun_ajaran }}</p>
                            @if($t->tanggal)
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-700">Rp {{ number_format($t->nominal, 0, ',', '.') }}</p>
                            @if($t->status == 'lunas')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">✓ Lunas</span>
                            @else
                                <div class="flex flex-col items-end gap-2">
                                    @php $pembayaranPending = $t->pembayaran->where('status', 'pending')->first(); @endphp
                                    @if($pembayaranPending)
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">⏳ Menunggu Verifikasi</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">✗ Belum Lunas</span>
                                        <a href="{{ route('ortu.pembayaran.create', $t->id) }}" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">💳 Bayar</a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-400">Belum ada tagihan</div>
                @endforelse
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-bold text-gray-700 mb-4">📤 Upload Bukti Pembayaran Mandiri</h2>
                <form method="POST" action="{{ route('ortu.pembayaran.mandiri') }}" enctype="multipart/form-data">
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
                        <input type="text" name="nama_pengirim"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Nama sesuai rekening" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal</label>
                        <input type="text" name="nominal" id="nominal_mandiri"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Contoh: 500.000" required>
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
                    </div>
                    <button type="submit" class="w-full bg-green-600 text-white py-3 rounded hover:bg-green-700 font-semibold">
                        Kirim Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>

        <div id="riwayat" class="hidden bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="p-4 bg-green-600">
                <h2 class="text-lg font-bold text-white">📜 Riwayat Pembayaran</h2>
            </div>
            @php $semuaPembayaran = $tagihan->flatMap(function($t) { return $t->pembayaran; })->sortByDesc('created_at'); @endphp
            @forelse($semuaPembayaran as $p)
            <div class="p-4 border-b hover:bg-gray-50">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $p->tagihan->jenis }}</p>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y H:i') }}</p>
                        <p class="text-sm text-gray-500">Via {{ strtoupper($p->metode) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp {{ number_format($p->tagihan->nominal, 0, ',', '.') }}</p>
                        @if($p->status == 'verified')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">✅ Terverifikasi</span>
                        @elseif($p->status == 'rejected')
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold">❌ Ditolak</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold">⏳ Menunggu</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="p-6 text-center text-gray-400">Belum ada riwayat pembayaran</div>
            @endforelse
        </div>

        @if(isset($pengaturan) && $pengaturan)
        <div class="bg-white rounded-lg shadow p-4 text-center text-sm text-gray-500 mb-6">
            Butuh bantuan? Hubungi: <span class="font-semibold text-green-700">📞 {{ $pengaturan->nama_kontak }} - {{ $pengaturan->no_telepon }}</span>
        </div>
        @endif

    </div>

    <script>
    function showMenu(id) {
        const panels = ['data-siswa', 'pembayaran', 'riwayat'];
        panels.forEach(p => document.getElementById(p).classList.add('hidden'));
        document.getElementById(id).classList.remove('hidden');
    }

    function copyNorek() {
        const norek = document.getElementById('norek').innerText.trim();
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(norek).then(function() {
                showCopied();
            }).catch(function() {
                fallbackCopy(norek);
            });
        } else {
            fallbackCopy(norek);
        }
    }

    function fallbackCopy(text) {
        const el = document.createElement('textarea');
        el.value = text;
        el.setAttribute('readonly', '');
        el.style.position = 'fixed';
        el.style.left = '-9999px';
        document.body.appendChild(el);

        if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
            const range = document.createRange();
            range.selectNodeContents(el);
            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            el.setSelectionRange(0, 999999);
        } else {
            el.select();
        }

        document.execCommand('copy');
        document.body.removeChild(el);
        showCopied();
    }

    function showCopied() {
        const btn = document.getElementById('copyBtn');
        btn.innerText = '✅ Tersalin!';
        btn.classList.remove('bg-green-600');
        btn.classList.add('bg-gray-500');
        setTimeout(() => {
            btn.innerText = '📋 Salin';
            btn.classList.remove('bg-gray-500');
            btn.classList.add('bg-green-600');
        }, 2000);
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

    document.addEventListener('DOMContentLoaded', function() {
        const inputNominal = document.getElementById('nominal_mandiri');
        if (inputNominal) {
            inputNominal.addEventListener('input', function(e) {
                let val = e.target.value.replace(/\D/g, '');
                if (val) {
                    e.target.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                } else {
                    e.target.value = '';
                }
            });
        }
    });
    </script>

</body>
</html>