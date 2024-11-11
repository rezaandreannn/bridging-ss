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
        Schema::create('ok_laporan_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->date('tanggal');
            $table->string('diagnosis_pre_operatif');
            $table->string('jaringan_eksekusi');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('permintaan_pa');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('ok_laporan_operasi');
    }
};
