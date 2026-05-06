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
        Schema::create('permohonan_bantuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('alamat_domisili');
            $table->string('no_whatsapp');
            $table->string('email')->nullable();
            $table->string('jenis_pemohon')->nullable();
            $table->string('sumber_info')->nullable();
            $table->text('referensi')->nullable();
            $table->string('pernah_mengajukan')->nullable();
            $table->text('waktu_terakhir_mengajukan')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('nominal', 15, 2)->nullable();
            $table->enum('status', ['pending', 'acc', 'tolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_bantuans');
    }
};
