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
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksiId');
            $table->foreign('transaksiId')
                ->references('id')
                ->on('transaksi')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('koleksiId');
            $table->foreign('koleksiId')
                ->references('id')
                ->on('koleksi')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('tanggalKembali')->nullable();
            $table->tinyInteger('status');
            $table->string('keterangan', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
    }
};
