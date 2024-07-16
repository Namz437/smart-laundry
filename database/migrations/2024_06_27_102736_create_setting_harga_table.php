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
        Schema::create('setting_harga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_cuci_id');
            $table->integer('harga_perKg');
            $table->timestamps();

            $table->foreign('type_cuci_id')->references('id')->on('type_cuci')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_harga');
    }
};
