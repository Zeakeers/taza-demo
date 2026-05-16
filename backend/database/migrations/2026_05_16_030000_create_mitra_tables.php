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
        Schema::create('mitra_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('mitra_logos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_section_id')->constrained()->onDelete('cascade');
            $table->string('name'); // partner name
            $table->string('logo'); // logo file path (uploaded)
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra_logos');
        Schema::dropIfExists('mitra_sections');
    }
};
