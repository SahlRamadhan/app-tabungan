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
            $table->integer('nominal');
            $table->integer('jumlah_angsuran');
            $table->date('tgl_angsuran');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['pending', 'belum', 'lunas'])->default('pending');
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
