<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin TU YAMASY',
            'email' => 'admin@yamasy.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $siswa = [
            ['nis' => '1234567890', 'nama' => 'Ahmad Fauzan', 'kelas' => '7A', 'tahun_ajaran' => '2026/2027', 'nama_ortu' => 'Budi Santoso', 'nama_ibu' => 'Siti Aminah', 'no_hp' => '081234567890'],
            ['nis' => '0987654321', 'nama' => 'Nurul Hikmah', 'kelas' => '7B', 'tahun_ajaran' => '2026/2027', 'nama_ortu' => 'Dedi Kurniawan', 'nama_ibu' => 'Rina Kartika', 'no_hp' => '081298765432'],
        ];

        foreach ($siswa as $data) {
            $s = Siswa::create($data);

            $s->tagihan()->create([
                'jenis' => 'SPP',
                'nominal' => 150000,
                'bulan' => 'Agustus',
                'tahun_ajaran' => '2026/2027',
                'status' => 'belum_lunas',
            ]);

            $t = $s->tagihan()->create([
                'jenis' => 'DSP',
                'nominal' => 1000000,
                'tahun_ajaran' => '2026/2027',
                'status' => 'belum_lunas',
            ]);

            Pembayaran::create([
                'tagihan_id' => $t->id,
                'metode' => 'qris',
                'status' => 'pending',
                'tgl_bayar' => now(),
            ]);
        }
    }
}
