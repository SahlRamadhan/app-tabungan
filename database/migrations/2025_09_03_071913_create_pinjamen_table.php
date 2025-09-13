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
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('jenispembayaran_id');
            $table->integer('nominal');
            $table->integer('tenor');
            $table->integer('no_rek');
            $table->date('tgl_pinjaman');
            $table->date('tgl_jatuhtempo');
            $table->enum('status', ['padding', 'approved', 'rejected', 'completed'])->default('padding');
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
