<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->bigInteger('nominal');
            $table->string('kategori')->nullable();
            $table->foreignId('admin_id')->constrained('users');
            $table->timestamp('tgl_pengeluaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};