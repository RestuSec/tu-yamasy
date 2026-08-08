<x-layout title="Pengeluaran - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Data Pengeluaran</h1>
        <a href="{{ route('admin.pengeluaran.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Tambah Pengeluaran
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
                    <th class="p-3 text-left">Keterangan</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Nominal</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluaran as $i => $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $pengeluaran->firstItem() + $i }}</td>
                    <td class="p-3 font-semibold">{{ $p->keterangan }}</td>
                    <td class="p-3">{{ $p->kategori ?? '-' }}</td>
                    <td class="p-3 text-red-600 font-semibold">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($p->tgl_pengeluaran)->format('d/m/Y') }}</td>
                    <td class="p-3">
                        <form method="POST" action="{{ route('admin.pengeluaran.destroy', $p->id) }}" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-400">Belum ada data pengeluaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $pengeluaran->links() }}
        </div>
    </div>
</x-layout>