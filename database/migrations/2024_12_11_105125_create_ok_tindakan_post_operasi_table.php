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
        Schema::connection('pku')->create('ok_tindakan_post_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->enum('status_pasien', ['1', '0']);
            $table->enum('catatan_anestesi', ['1', '0']);
            $table->enum('laporan_pembedahan', ['1', '0']);
            $table->enum('perencanaan_pasca_medis', ['1', '0']);
            $table->enum('checklist_keselamatan_pasien', ['1', '0']);
            $table->enum('checklist_monitoring', ['1', '0']);
            $table->enum('askep_perioperatif', ['1', '0']);
            $table->enum('lembar_pemantauan', ['1', '0']);
            $table->enum('formulir_pemeriksaan', ['1', '0']);
            $table->enum('sampel_pemeriksaan', ['1', '0']);
            $table->enum('foto_rontgen', ['1', '0']);
            $table->enum('resep', ['1', '0']);
            $table->enum('lainnya', ['1', '0']);
            $table->string('deskripsi_lainnya');
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
        Schema::connection('pku')->dropIfExists('ok_tindakan_post_operasi');
    }
};
