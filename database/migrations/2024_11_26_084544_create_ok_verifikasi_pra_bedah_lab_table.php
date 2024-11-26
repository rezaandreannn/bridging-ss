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
        Schema::connection('pku')->create('ok_verifikasi_pra_bedah_lab', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('laboratorium');
            $table->string('lab_hemoglobin');
            $table->string('lab_leukosit');
            $table->string('lab_trombosit');
            $table->string('lab_hematrokit');
            $table->string('lab_bt');
            $table->string('lab_ct');
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
        Schema::connection('pku')->dropIfExists('ok_verifikasi_pra_bedah_lab');
    }
};
