<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pku')->create('fis_lembar_spkfr', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->string('kode_transaksi_fisio');
            $table->string('pemeriksaan_fisik');
            $table->string('diagnosis_medis');
            $table->string('diagnosis_fungsi');
            $table->string('pemeriksaan_penunjang')->nullable();
            $table->string('tata_laksana_kfr');
            $table->string('penyakit_akibat_kerja')->nullable();
            $table->string('deskripsi_akibat_kerja')->nullable();
            $table->string('create_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pku')->dropIfExists('fis_lembar_spkfr');
    }
};
