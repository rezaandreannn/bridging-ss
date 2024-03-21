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
        Schema::create('simrs_dokters', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokter');
            $table->string('jenis_profesi');
            $table->string('spesialis');
            $table->string('nama_dokter');
            $table->string('nik');
            $table->string('tgl_lahir');
            $table->string('agama');
            $table->string('email');
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('pemeriksaan');
            $table->string('visit');
            $table->string('konsul');
            $table->string('tindakan');
            $table->string('lain');
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
        Schema::dropIfExists('simrs_dokters');
    }
};
