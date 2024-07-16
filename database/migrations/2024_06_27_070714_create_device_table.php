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
        Schema::create('device', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id');
            $table->foreignId('type_cuci_id');
            $table->string('nama_device');
            $table->string('mac_address');
	        $table->boolean('status_booking')->default(false);
	        $table->boolean('status_mesin')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps(); 

            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_cuci_id')->references('id')->on('type_cuci')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device');
    }
};
