<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('letak_barang');
            $table->string('nama_peminjam');
            $table->string('alamat_peminjam');
            $table->string('nomor_handphone');
            $table->string('surat_tugas');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->string('status')->default('menunggu persetujuan');
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
