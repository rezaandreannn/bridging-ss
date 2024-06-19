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
        Schema::connection('pku')->create('assesmen_dokter_fisioterapi', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->string('kode_transaksi_fisio');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('cara_datang');
            $table->string('deskripsi_cara_datang');
            $table->text('anamnesa');
            $table->string('keadaan_umum');
            $table->string('kesadaran');
            $table->string('tekanan_darah');
            $table->string('nadi');
            $table->string('respirasi');
            $table->string('suhu');
            $table->string('berat_badan');
            $table->string('prothesa');
            $table->string('orthosis');
            $table->string('status_psikologi');
            $table->string('status_mental');
            $table->string('diagnosa_klinis');
            $table->string('rencana_tindakan');
            $table->text('jenis_tindakan')->nullable();
            $table->string('rencana_rujukan');
            $table->text('deskripsi_rujukan')->nullable();
            $table->string('rencana_konsul');
            $table->text('deskripsi_konsul')->nullable();
            $table->integer('anjuran_terapi');
            $table->integer('evaluasi_terapi');
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
        Schema::connection('pku')->dropIfExists('assesmen_dokter_fisioterapi');
    }

    // cara migrasinya 
    // php artisan migrate --path=database\migrations\2024_06_16_083845_create_assesmen_dokter_fisioterapi_table.php
};
