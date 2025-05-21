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
        Schema::create('ijins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nama');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->enum('keterangan',['IJIN/CUTI','SAKIT']);
            $table->timestamps();

            $table->foreign('id_nama')->references('id')->on('gurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ijins');
    }
};
