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
        Schema::connection('pku')->create('poli_mata_asesmen_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('NO_REG');
            $table->string('anamnesa')->nullable();
            $table->string('riwayat_penyakit')->nullable();
            $table->string('status_psikologi')->nullable();
            $table->string('keadaan_umum')->nullable();
            $table->string('kesadaran')->nullable();
            $table->string('status_mental')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->string('nadi')->nullable();
            $table->string('respirasi')->nullable();
            $table->string('suhu')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('KONJUNGTIVA')->nullable();
            $table->string('SKELERA')->nullable();
            $table->string('BIBIR_LIDAH')->nullable();
            $table->string('DIAGNOSA')->nullable();
            $table->string('discharge')->nullable();
            $table->string('tonometri_od')->nullable();
            $table->string('tonometri_os')->nullable();
            $table->string('aplansi_od')->nullable();
            $table->string('aplansi_os')->nullable();
            $table->string('anel_od')->nullable();
            $table->string('anel_os')->nullable();
            $table->string('ekstremitas_od')->nullable();
            $table->string('ekstremitas_os')->nullable();
            $table->string('CREATE_BY');
            $table->string('UPDATE_BY')->nullable();
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
        Schema::connection('pku')->dropIfExists('poli_mata_asesmen_dokter');
    }
};