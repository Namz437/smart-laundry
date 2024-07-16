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
        Schema::create('transaksi_cucian_add', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_cuci_id');
            $table->foreignId('addition_id');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->timestamps();

            $table->foreign('transaksi_cuci_id')->references('id')->on('transaksi_cuci')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('addition_id')->references('id')->on('addition')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_cucian_add');
    }
};
