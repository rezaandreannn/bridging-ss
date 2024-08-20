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
        Schema::connection('pku')->create('fis_order_alkes', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->string('jenis_alat')->nullable();
            $table->string('biaya')->nullable();
            $table->string('lingkar_pinggang')->nullable();
            $table->string('no_sep')->nullable();
            $table->string('jenis_rawat')->nullable();
            $table->string('ruangan_rawat')->nullable();
            $table->string('tanggal_masuk')->nullable();
            $table->string('tanggal_pulang')->nullable();
            $table->string('create_by')->nullable();
            $table->string('verifikasi_by')->nullable();
            $table->string('verifikasi_at')->nullable();
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
        Schema::connection('pku')->dropIfExists('fis_order_alkes');
    }
};
