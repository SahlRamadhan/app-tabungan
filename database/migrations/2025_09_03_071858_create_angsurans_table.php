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
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->integer('pinjaman_id');
            $table->integer('user_id');
            $table->integer('jenispembayaran_id');
            $table->integer('nomor_angsuran');
            $table->integer('nominal');
            $table->integer('jumlah_angsuran');
            $table->date('tgl_bayar')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['padding', 'belum', 'lunas'])->default('padding');
            $table->integer('approved_by_id')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};
