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
        Schema::create('konfirmasi_donasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('no_whatsapp');
            $table->date('tanggal_transfer');
            $table->string('program');
            $table->decimal('nominal', 20, 2);
            $table->string('bukti_pembayaran');
            $table->enum('status', ['pending', 'acc', 'tolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfirmasi_donasis');
    }
};
