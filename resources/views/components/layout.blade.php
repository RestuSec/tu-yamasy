<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TU YAMASY' }}</title>
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
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-white text-green-700 px-3 py-1 rounded text-sm font-semibold">Logout</button>
            </form>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen shadow-md p-4">
            <ul class="space-y-2 mt-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}" 
                        class="flex items-center gap-2 p-3 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        📊 Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.siswa.index') }}" 
                        class="flex items-center gap-2 p-3 rounded {{ request()->routeIs('admin.siswa.*') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        👥 Data Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tagihan.index') }}" 
                        class="flex items-center gap-2 p-3 rounded {{ request()->routeIs('admin.tagihan.*') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        📋 Tagihan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pembayaran.index') }}" 
                        class="flex items-center gap-2 p-3 rounded {{ request()->routeIs('admin.pembayaran.*') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        ✅ Verifikasi Pembayaran
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengeluaran.index') }}" 
                        class="flex items-center gap-2 p-3 rounded {{ request()->routeIs('admin.pengeluaran.*') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        💸 Pengeluaran
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengaturan.index') }}" 
                        class="flex items-center gap-2 p-3 rounded {{ request()->routeIs('admin.pengaturan.*') ? 'bg-green-100 text-green-700 font-semibold' : 'hover:bg-gray-100' }}">
                        ⚙️ Pengaturan
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

</body>
</html>