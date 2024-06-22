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
        Schema::connection('pku')->create('lembar_uji_fungsi_fisioterapi', function (Blueprint $table) {
            $table->id();
            $table->string('diagnosis_fungsional');
            $table->string('prosedur_kfr');
            $table->string('hasil_pemeriksaan');
            $table->string('kesimpulan');
            $table->string('rekomendasi');
            $table->string('create_by');
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
        Schema::connection('pku')->dropIfExists('lembar_uji_fungsi_fisioterapi');
    }
};
