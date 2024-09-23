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
        Schema::connection('pku')->create('poli_mata_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('NO_REG');
            $table->text('anamnesa')->nullable();
            $table->text('RIWAYAT_SEKARANG')->nullable();
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
            $table->text('DIAGNOSA')->nullable();
            $table->string('edukasi')->nullable();
            $table->string('konsul')->nullable();
            $table->string('keterangan_konsul')->nullable();
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
        Schema::connection('pku')->dropIfExists('poli_mata_dokter');
    }
};
