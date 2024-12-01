<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePesananDetailsAddResi extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesanan_details', function (Blueprint $table) {
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('cascade');
            $table->string('resi_number')->nullable(); // Nomor resi yang akan dibuat otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan_details', function (Blueprint $table) {
            $table->dropForeign(['courier_id']);
            $table->dropColumn(['courier_id', 'resi_number']);
        });
    }
}
