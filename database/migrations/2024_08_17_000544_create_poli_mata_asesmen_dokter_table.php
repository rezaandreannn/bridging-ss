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
            $table->string('FS_KD_REG');
            $table->string('KONJUNGTIVA')->nullable();
            $table->string('SKELERA')->nullable();
            $table->string('BIBIR_LIDAH')->nullable();
            $table->string('palpebra_kiri')->nullable();
            $table->string('palpebra_kanan')->nullable();
            $table->string('conjuctiva_kiri')->nullable();
            $table->string('conjuctiva_kanan')->nullable();
            $table->string('cornea_kiri')->nullable();
            $table->string('cornea_kanan')->nullable();
            $table->string('coa_kiri')->nullable();
            $table->string('coa_kanan')->nullable();
            $table->string('iris_kiri')->nullable();
            $table->string('iris_kanan')->nullable();
            $table->string('pupil_kiri')->nullable();
            $table->string('pupil_kanan')->nullable();
            $table->string('lensa_kiri')->nullable();
            $table->string('lensa_kanan')->nullable();
            $table->string('vitreosh_kanan')->nullable();
            $table->string('vitreosh_kiri')->nullable();
            $table->string('biometri_kiri')->nullable();
            $table->string('biometri_kanan')->nullable();
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
