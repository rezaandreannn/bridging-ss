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
        Schema::connection('pku')->create('ok_verifikasi_pra_bedah_berkas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('status_pasien');
            $table->string('assesmen_pra_bedah');
            $table->string('penandaan_lokasi');
            $table->string('informed_consent_bedah');
            $table->string('informed_consent_anastesi');
            $table->string('assesmen_pra_anastesi_sedasi');
            $table->string('edukasi_anastesi');
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
        Schema::connection('pku')->dropIfExists('ok_verifikasi_pra_bedah_berkas');
    }
};
