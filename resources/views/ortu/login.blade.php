<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Orang Tua - TU YAMASY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- Logo & Title -->
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('images/logo-yamasy.png') }}" class="w-20 h-20 object-contain mb-3">
                <h1 class="text-2xl font-bold text-green-700">TU YAMASY</h1>
                <p class="text-sm text-gray-500">Portal Orang Tua / Siswa</p>
                <p class="text-xs text-gray-400 mt-1">Pondok Benda - Tangerang Selatan</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('ortu.login.post') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIS Siswa</label>
                    <input type="text" name="nis" value="{{ old('nis') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Masukkan NIS siswa" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu Kandung</label>
                    <input type="text" name="nama_ibu"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Masukkan nama ibu kandung" required>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 font-semibold">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-gray-400">
                Butuh bantuan? Hubungi TU YAMASY
            </div>
        </div>
    </div>
</body>
</html>