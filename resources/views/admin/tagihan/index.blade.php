<x-layout title="Tagihan - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Data Tagihan</h1>
        <a href="{{ route('admin.tagihan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Tambah Tagihan
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
                    <th class="p-3 text-left">Kelas</th>
                    <th class="p-3 text-left">Jenis</th>
                    <th class="p-3 text-left">Nominal</th>
                    <th class="p-3 text-left">Bulan</th>
                    <th class="p-3 text-left">Tahun Ajaran</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tagihan as $i => $t)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $tagihan->firstItem() + $i }}</td>
                    <td class="p-3 font-semibold">{{ $t->siswa->nama }}</td>
                    <td class="p-3">{{ $t->siswa->kelas }}</td>
                    <td class="p-3">{{ $t->jenis }}</td>
                    <td class="p-3">Rp {{ number_format($t->nominal, 0, ',', '.') }}</td>
                    <td class="p-3">{{ $t->bulan ?? '-' }}</td>
                    <td class="p-3">{{ $t->tahun_ajaran }}</td>
                    <td class="p-3">{{ $t->tanggal ? \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') : '-' }}</td>
                    <td class="p-3">
                        @if($t->status == 'lunas')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">Lunas</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">Belum Lunas</span>
                        @endif
                    </td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.tagihan.edit', $t->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded text-xs hover:bg-yellow-500">Edit</a>
                        <form method="POST" action="{{ route('admin.tagihan.destroy', $t->id) }}" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="p-6 text-center text-gray-400">Belum ada data tagihan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $tagihan->links() }}
        </div>
    </div>
</x-layout>