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
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->string('hari', 45);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unsignedBigInteger('guru_id_guru');
            $table->unsignedBigInteger('kelas_id_kelas');
            $table->unsignedBigInteger('mapel_id_mapel');
            
            $table->foreign('guru_id_guru')->references('id_guru')->on('guru')->onDelete('cascade');
            $table->foreign('kelas_id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('mapel_id_mapel')->references('id_mapel')->on('mapel')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajaran');
    }
};
