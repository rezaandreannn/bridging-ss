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
        Schema::connection('pku')->create('poli_mata_gambar', function (Blueprint $table) {
            $table->id();
            $table->string('NO_REG');
            $table->text('GAMBAR')->nullable();
            $table->string('TIPE')->nullable();
            $table->text('DESKRIPSI')->nullable();
            $table->string('CREATE_BY');
            $table->string('UPDATE_BY')->nullable();
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
        Schema::connection('pku')->dropIfExists('poli_mata_gambar');
    }
};
