<x-layout title="Verifikasi Pembayaran - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Verifikasi Pembayaran</h1>
        <a href="{{ route('admin.pembayaran.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Input Pembayaran Tunai
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Siswa</th>
                    <th class="p-3 text-left">Jenis Tagihan</th>
                    <th class="p-3 text-left">Nominal</th>
                    <th class="p-3 text-left">Metode</th>
                    <th class="p-3 text-left">Bukti</th>
                    <th class="p-3 text-left">Tgl Bayar</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayaran as $i => $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $pembayaran->firstItem() + $i }}</td>
                    <td class="p-3 font-semibold">{{ $p->tagihan->siswa->nama }}</td>
                    <td class="p-3">{{ $p->tagihan->jenis }}</td>
                    <td class="p-3">Rp {{ number_format($p->tagihan->nominal, 0, ',', '.') }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $p->metode == 'tunai' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                            {{ strtoupper($p->metode) }}
                        </span>
                    </td>
                    <td class="p-3">
                        @if($p->bukti)
                            <a href="{{ asset('storage/'.$p->bukti) }}" target="_blank" class="text-blue-500 underline text-xs">Lihat Bukti</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $p->tgl_bayar ? \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') : '-' }}</td>
                    <td class="p-3">
                        @if($p->status == 'verified')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">Terverifikasi</span>
                        @elseif($p->status == 'rejected')
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">Ditolak</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-semibold">Pending</span>
                        @endif
                    </td>
                    <td class="p-3">
                        @if($p->status == 'pending')
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('admin.pembayaran.verifikasi', $p->id) }}">
                                    @csrf
                                    <button class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">✓ Verifikasi</button>
                                </form>
                                <form method="POST" action="{{ route('admin.pembayaran.tolak', $p->id) }}">
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">✗ Tolak</button>
                                </form>
                            </div>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="p-6 text-center text-gray-400">Belum ada data pembayaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $pembayaran->links() }}
        </div>
    </div>
</x-layout>