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
        Schema::connection('pku')->create('ok_perencanaan_medis_pasca_bedah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('tingkat_perawatan');
            $table->string('monitoring_ttv_start');
            $table->string('monitoring_ttv_end');
            $table->string('konsultasi_pelayanan');
            $table->text('terapi');
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
        Schema::connection('pku')->dropIfExists('ok_perencanaan_medis_pasca_bedah');
    }
};
