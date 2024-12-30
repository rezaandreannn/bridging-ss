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
        Schema::connection('pku')->create('ok_assesmen_pra_bedah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->text('anamnesa');
            $table->text('pemeriksaan_fisik');
            $table->text('diagnosa');
            $table->text('planning');
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
        Schema::connection('pku')->dropIfExists('ok_assesmen_pra_bedah');
    }
};
