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
        Schema::connection('pku')->create('ok_alat_post_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('ngt');
            $table->string('drain');
            $table->string('tampon_hidung');
            $table->string('tampon_gigi');
            $table->string('tampon_abdomen');
            $table->string('tampon_vagina');
            $table->string('tranfusi');
            $table->string('ivfd');
            $table->string('deskripsi_ivfd');
            $table->string('kompres_luka');
            $table->string('dc');
            $table->string('lainnya');
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
        Schema::connection('pku')->dropIfExists('ok_alat_post_operasi');
    }
};
