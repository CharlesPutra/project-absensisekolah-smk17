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
        Schema::create('jadwalkaryawans', function (Blueprint $table) {
            $table->id();
            $table->string('no_jadwal');
            $table->string('hari');
            $table->string('masuk');
            $table->string('pulang');
            $table->string('keterlambatan');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwalkaryawans');
    }
};
