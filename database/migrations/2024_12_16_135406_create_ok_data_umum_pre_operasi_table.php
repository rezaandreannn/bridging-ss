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
        Schema::connection('pku')->create('ok_data_umum_pre_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('diagnosa');
            $table->string('jenis_operasi');
            $table->string('nama_operator');
            $table->string('puasa_jam');
            $table->enum('riwayat_asma', ['1', '0']);
            $table->string('alergi');
            $table->string('antibiotik_profilaksis');
            $table->string('antibiotik_profilaksis_jam');
            $table->string('premedikasi');
            $table->string('premedikasi_jam');
            $table->string('ivfd');
            $table->string('dc');
            $table->string('assesmen_pra_bedah');
            $table->string('edukasi_anastesi');
            $table->string('informed_consent_bedah');
            $table->string('informed_consent_anastesi');
            $table->string('darah');
            $table->string('gol');
            $table->string('obat');
            $table->string('rontgen');
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
        Schema::connection('pku')->dropIfExists('ok_data_umum_pre_operasi');
    }
};
