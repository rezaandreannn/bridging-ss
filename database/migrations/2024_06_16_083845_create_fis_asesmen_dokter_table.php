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
        Schema::connection('pku')->create('fis_asesmen_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->string('kode_transaksi_fisio');
            $table->date('tanggal');
            $table->time('jam');
            $table->text('anamnesa');
            $table->string('tekanan_darah');
            $table->string('nadi');
            $table->string('respirasi');
            $table->string('suhu');
            $table->string('berat_badan');
            $table->string('prothesa')->nullable();
            $table->string('orthosis')->nullable();
            $table->string('diagnosa_klinis');
            $table->string('terapi')->nullable();
            $table->string('rencana_tindakan')->nullable();
            $table->text('jenis_tindakan')->nullable();
            $table->string('rencana_rujukan')->nullable();
            $table->text('deskripsi_rujukan')->nullable();
            $table->string('rencana_konsul')->nullable();
            $table->text('deskripsi_konsul')->nullable();
            $table->integer('anjuran_terapi');
            $table->integer('evaluasi_terapi');
            $table->string('create_by');
            $table->timestamps();
        });
    }

    // public function up()
    // {
    //     Schema::connection('pku')->create('fis_asesmen_dokter', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('no_registrasi');
    //         $table->string('kode_transaksi_fisio');
    //         $table->date('tanggal');
    //         $table->time('jam');
    //         $table->string('cara_datang')->nullable();
    //         $table->string('deskripsi_cara_datang')->nullable();
    //         $table->text('anamnesa');
    //         $table->string('keadaan_umum')->nullable();
    //         $table->string('kesadaran')->nullable();
    //         $table->string('tekanan_darah');
    //         $table->string('nadi');
    //         $table->string('respirasi');
    //         $table->string('suhu');
    //         $table->string('berat_badan');
    //         $table->string('prothesa')->nullable();
    //         $table->string('orthosis')->nullable();
    //         $table->string('status_psikologi')->nullable();
    //         $table->string('status_mental')->nullable();
    //         $table->string('diagnosa_klinis');
    //         $table->string('terapi')->nullable();
    //         $table->string('rencana_tindakan')->nullable();
    //         $table->text('jenis_tindakan')->nullable();
    //         $table->string('rencana_rujukan')->nullable();
    //         $table->text('deskripsi_rujukan')->nullable();
    //         $table->string('rencana_konsul')->nullable();
    //         $table->text('deskripsi_konsul')->nullable();
    //         $table->integer('anjuran_terapi');
    //         $table->integer('evaluasi_terapi');
    //         $table->string('create_by');
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pku')->dropIfExists('fis_asesmen_dokter');
    }

    // cara migrasinya 
    // php artisan migrate --path=database\migrations\2024_06_16_083845_create_assesmen_dokter_fisioterapi_table.php
};
