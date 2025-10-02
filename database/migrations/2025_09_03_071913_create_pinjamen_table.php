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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('jenispembayaran_id');
            $table->string('nomor_pinjaman')->unique();
            $table->integer('nominal');
            $table->integer('nominal_angsuran');
            $table->integer('tenor');
            $table->date('tgl_pinjaman')->nullable();
            $table->date('tgl_jatuhtempo')->nullable();
            $table->enum('status', ['padding', 'approved', 'rejected', 'completed'])->default('padding');
            $table->integer('approved_by_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamen');
    }
};
