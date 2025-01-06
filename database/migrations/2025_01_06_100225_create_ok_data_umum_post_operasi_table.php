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
        Schema::connection('pku')->create('ok_data_umum_post_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('diagnosa_prabedah');
            $table->string('diagnosa_pascabedah');
            $table->string('jenis_operasi');
            $table->string('dokter_operator');
            $table->string('asisten_bedah');
            $table->time('jam_operasi');
            $table->string('jenis_anastesi');
            $table->string('dokter_anastesi');
            $table->string('asisten_anastesi');
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
        Schema::connection('pku')->dropIfExists('ok_data_umum_post_operasi');
    }
};
