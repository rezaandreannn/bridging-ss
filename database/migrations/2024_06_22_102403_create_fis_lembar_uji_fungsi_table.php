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
        Schema::connection('pku')->create('fis_lembar_uji_fungsi', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->string('kode_transaksi_fisio');
            $table->string('diagnosis_fungsional');
            $table->string('prosedur_kfr');
            $table->string('kesimpulan')->nullable();
            $table->string('rekomendasi');
            $table->string('edukasi')->nullable();
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
        Schema::connection('pku')->dropIfExists('fis_lembar_uji_fungsi');
    }
};
