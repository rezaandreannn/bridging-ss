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
        Schema::connection('pku')->create('ok_tindakan_pre_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->enum('lapor_dokter', ['1', '0']);
            $table->enum('lapor_kamar', ['1', '0']);
            $table->enum('surat_izin_pembedahan', ['1', '0']);
            $table->enum('tandai_daerah_operasi', ['1', '0']);
            $table->enum('memakai_gelang_identitas', ['1', '0']);
            $table->enum('melepas_aksesoris', ['1', '0']);
            $table->enum('menghapus_aksesoris', ['1', '0']);
            $table->enum('melakukan_oral_hygiene', ['1', '0']);
            $table->enum('memasang_bidai', ['1', '0']);
            $table->enum('memasang_infuse', ['1', '0']);
            $table->enum('memasang_dc', ['1', '0']);
            $table->string('deskripsi_dc')->nullable();
            $table->enum('memasang_ngt', ['1', '0']);
            $table->string('deskripsi_ngt')->nullable();
            $table->enum('memasang_drainage', ['1', '0']);
            $table->enum('memasang_wsd', ['1', '0']);
            $table->enum('mencukur_daerah_operasi', ['1', '0']);
            $table->enum('lainnya', ['1', '0']);
            $table->string('deskripsi_lainnya')->nullable();
            $table->enum('penyakit_dm', ['1', '0']);
            $table->enum('penyakit_hipertensi', ['1', '0']);
            $table->enum('penyakit_tb_paru', ['1', '0']);
            $table->enum('penyakit_hiv', ['1', '0']);
            $table->enum('penyakit_hepatitis', ['1', '0']);
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
        Schema::connection('pku')->dropIfExists('ok_tindakan_pre_operasi');
    }
};
