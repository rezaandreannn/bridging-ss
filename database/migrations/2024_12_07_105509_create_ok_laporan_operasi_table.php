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
            $table->string('diagnosa_pre_op');
            $table->string('diagnosa_post_op');
            $table->string('jaringan_dieksekusi');
            $table->date('selesai_operasi');
            $table->enum('permintaan_pa', ['Ya', 'Tidak']);
            $table->text('laporan_operasi');
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
