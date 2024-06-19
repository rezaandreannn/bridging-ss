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
        Schema::connection('pku')->create('assesmen_dokter_fisioterapi', function (Blueprint $table) {
            $table->id();
            $table->string('name');
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
        Schema::connection('pku')->dropIfExists('assesmen_dokter_fisioterapi');
    }

    // cara migrasinya 
    // php artisan migrate --path=database\migrations\2024_06_16_083845_create_assesmen_dokter_fisioterapi_table.php
};
