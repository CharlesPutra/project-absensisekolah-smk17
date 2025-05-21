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
        Schema::table('jadwalgurus', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jurusan')->after('keterlambatan')->required();

            $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwalgurus', function (Blueprint $table) {
            //
        });
    }
};
