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
 
        Schema::connection('pku')->create('ok_operator_asisten_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('nama_operator')->nullable();
            $table->string('nama_asisten')->nullable();
            $table->string('nama_perawat')->nullable();
            $table->string('nama_ahli_anastesi')->nullable();
            $table->string('nama_anastesi')->nullable();
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
        Schema::connection('pku')->dropIfExists('ok_operator_asisten_detail');
    }
};
