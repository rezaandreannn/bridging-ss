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
        Schema::connection('pku')->create('fis_tr_jenis', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->string('kode_tr_fisio');
            $table->integer('id_jenis_fisioterapi');
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
        Schema::connection('pku')->dropIfExists('fis_tr_jenis');
    }
};
