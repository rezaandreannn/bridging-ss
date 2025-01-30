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
        
        Schema::connection('pku')->create('ok_verifikasi_pra_bedah_others', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->time('estimasi_waktu');
            $table->string('rencana_tindakan');
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
        Schema::connection('pku')->dropIfExists('ok_verifikasi_pra_bedah_others');
    }
};
