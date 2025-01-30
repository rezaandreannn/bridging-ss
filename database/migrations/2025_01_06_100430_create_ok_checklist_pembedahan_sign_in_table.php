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
        Schema::connection('pku')->create('ok_checklist_pembedahan_sign_in', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('identitas_pasien');
            $table->string('lokasi_operasi_pasien');
            $table->string('mesin_anestesi_lengkap');
            $table->string('alergi_pasien');
            $table->string('riwayat_asma_pasien');
            $table->string('pemasangan_implant');
            $table->string('kehilangan_darah');
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
        Schema::connection('pku')->dropIfExists('ok_checklist_pembedahan_sign_in');
    }
};
