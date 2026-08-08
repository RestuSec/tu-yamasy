<x-layout title="Data Siswa - TU YAMASY">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Data Siswa</h1>
        <a href="{{ route('admin.siswa.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Tambah Siswa
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
                    <th class="p-3 text-left">NIS</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Kelas</th>
                    <th class="p-3 text-left">Tahun Ajaran</th>
                    <th class="p-3 text-left">Nama Ortu</th>
                    <th class="p-3 text-left">No HP</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $i => $s)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $siswa->firstItem() + $i }}</td>
                    <td class="p-3 font-mono">{{ $s->nis }}</td>
                    <td class="p-3 font-semibold">{{ $s->nama }}</td>
                    <td class="p-3">{{ $s->kelas }}</td>
                    <td class="p-3">{{ $s->tahun_ajaran }}</td>
                    <td class="p-3">{{ $s->nama_ortu }}</td>
                    <td class="p-3">{{ $s->no_hp ?? '-' }}</td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.siswa.edit', $s->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded text-xs hover:bg-yellow-500">Edit</a>
                        <form method="POST" action="{{ route('admin.siswa.destroy', $s->id) }}" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-6 text-center text-gray-400">Belum ada data siswa</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $siswa->links() }}
        </div>
    </div>
</x-layout>