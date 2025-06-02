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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->integer('no_guru');
            $table->string('nama_guru');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->enum('karyawan', ['Karyawan', 'Guru']);
            $table->unsignedBigInteger('id_jadwalkaryawan')->nullable();
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->unsignedBigInteger('id_jadwalguru')->nullable();
            $table->timestamps();

            $table->foreign('id_jadwalkaryawan')->references('id')->on('jadwalkaryawans')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('cascade');
            $table->foreign('id_jadwalguru')->references('id')->on('jadwalgurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
