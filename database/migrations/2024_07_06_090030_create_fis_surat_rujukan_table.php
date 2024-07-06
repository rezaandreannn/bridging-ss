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
        Schema::connection('pku')->create('fis_surat_rujukan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_registrasi');
            $table->string('tujuan_rujukan');
            $table->string('alamat_rujukan');
            $table->string('lama_perawatan');
            $table->string('anamnesa');
            $table->string('pemeriksaan_fisik');
            $table->string('hasil_pemeriksaan_penunjang');
            $table->string('diagnosa');
            $table->string('terapi_yang_diberikan');
            $table->string('alasan_rujuk');
            $table->string('nohp_tujuan');
            $table->string('dokter_rujuk');
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
        Schema::connection('pku')->dropIfExists('fis_surat_rujukan');
    }
};
