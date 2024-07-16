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
        Schema::create('transaksi_cuci_real', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_cucian_id');
            $table->foreignId('users_id');
            $table->foreignId('device_id');
            $table->string('waktu_cuci');
            $table->string('status_transaksi');
            $table->integer('total_harga_cucian');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_id')->references('id')->on('device')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transaksi_cucian_id')->references('id')->on('transaksi_cucian')->onDelete('cascade')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_cuci_real');
    }
};
