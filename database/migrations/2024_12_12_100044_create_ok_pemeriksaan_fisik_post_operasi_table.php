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
        Schema::connection('pku')->create('ok_pemeriksaan_fisik_post_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('keadaan_umum');
            $table->string('kesadaran');
            $table->string('tekanan_darah');
            $table->string('nadi');
            $table->string('suhu');
            $table->string('pernafasan');
            $table->text('instruksi_dokter');
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
        Schema::connection('pku')->dropIfExists('ok_pemeriksaan_fisik_post_operasi');
    }
};
