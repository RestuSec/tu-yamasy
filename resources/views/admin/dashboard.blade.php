<x-layout title="Dashboard Admin - TU YAMASY">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Total Siswa</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalSiswa }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Total Pemasukan</p>
            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Total Pengeluaran</p>
            <p class="text-2xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-5 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Pembayaran Pending</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $pembayaranPending }}</p>
        </div>
    </div>
</x-layout>