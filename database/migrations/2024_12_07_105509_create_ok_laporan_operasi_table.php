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
        Schema::connection('pku')->create('ok_laporan_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->date('tanggal');
            $table->text('diagnosa_pre_op');
            $table->text('diagnosa_post_op');
            $table->text('jaringan_dieksekusi');
            $table->time('mulai_operasi');
            $table->time('selesai_operasi');
            $table->string('lama_operasi');
            $table->enum('permintaan_pa', ['1', '0']);
            $table->text('laporan_operasi');
            $table->string('pendarahan')->nullable();
            $table->string('macam_operasi')->nullable();
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
        Schema::connection('pku')->dropIfExists('ok_laporan_operasis');
    }
};
