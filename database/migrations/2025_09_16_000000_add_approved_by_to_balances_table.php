<?php
// database/migrations/2025_09_16_000001_add_approved_by_id_to_balances_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('balances', function (Blueprint $table) {
            $table->unsignedBigInteger('approved_by_id')->nullable()->after('status');
            $table->foreign('approved_by_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('balances', function (Blueprint $table) {
            $table->dropForeign(['approved_by_id']);
            $table->dropColumn('approved_by_id');
        });
    }
};
