<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('balances', function (Blueprint $table) {
            $table->enum('type', ['deposit', 'withdraw'])->default('deposit')->after('jenispembayaran_id');
        });
    }

    public function down()
    {
        Schema::table('balances', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
