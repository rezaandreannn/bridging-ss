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
        Schema::connection('pku')->create('ok_checklist_pembedahan_sign_out', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('tindakan_dicatat');
            $table->string('instrumen_alat');
            $table->string('jaringan_dikirimkan_pa');
            $table->string('masalah_peralatan');
            $table->string('masalah_pasien');
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
        Schema::connection('pku')->dropIfExists('ok_checklist_pembedahan_sign_out');
    }
};
