<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'simpan_pokok')) {
                $table->integer('simpan_pokok')->default(0)->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'last_principal_added_at')) {
                $table->timestamp('last_principal_added_at')->nullable()->after('simpan_pokok');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'last_principal_added_at')) {
                $table->dropColumn('last_principal_added_at');
            }
            if (Schema::hasColumn('users', 'simpan_pokok')) {
                $table->dropColumn('simpan_pokok');
            }
        });
    }
};
