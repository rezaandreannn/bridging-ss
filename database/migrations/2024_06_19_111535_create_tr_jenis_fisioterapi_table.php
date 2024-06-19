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
        Schema::connection('pku')->create('tr_jenis_fisioterapi', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->string('kode_tr_fisio');
            $table->integer('id_jenis_fisioterapi');
            $table->timestamps();
            $table->foreign('kode_tr_fisio')->references('kode_transaksi_fisio')->on('assesmen_dokter_fisioterapi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_jenis_fisioterapi')->references('ID_JENIS_FISIO')->on('TAC_COM_FISIOTERAPI_MASTER')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_jenis_fisioterapi');
    }
};
