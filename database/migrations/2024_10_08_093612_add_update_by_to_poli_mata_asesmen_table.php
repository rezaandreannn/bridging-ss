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
        Schema::connection('pku')->table('poli_mata_asesmen', function (Blueprint $table) {
            $table->string('UPDATE_BY')->nullable(); // Menambahkan kolom 'UPDATE_BY' ke tabel yang sudah ada
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poli_mata_asesmen', function (Blueprint $table) {
            //
        });
    }
};
