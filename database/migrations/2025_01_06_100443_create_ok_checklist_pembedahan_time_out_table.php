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
        Schema::connection('pku')->create('ok_checklist_pembedahan_time_out', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('perkenalan_diri_peran');
            $table->string('nama_pasien');
            $table->string('tindakan_tempat_posisi_direncanakan');
            $table->string('kehilangan_darah');
            $table->string('persyaratan_peralatan_khusus');
            $table->string('langkah_kritis_tak_terduga');
            $table->string('masalah_spesifik_pasien');
            $table->string('derajat_asa_pasien');
            $table->string('pemantauan_peralatan');
            $table->string('sterilitas_instrumentasi');
            $table->string('masalah_peralatan');
            $table->string('infeksi_lokasi');
            $table->string('profilaksis_vte');
            $table->string('hasil_radiologi');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::connection('pku')->dropIfExists('ok_checklist_pembedahan_time_out');
    }
};
