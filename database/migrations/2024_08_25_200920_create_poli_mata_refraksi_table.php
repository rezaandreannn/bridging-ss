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
        Schema::connection('pku')->create('poli_mata_refraksi', function (Blueprint $table) {
            $table->id();
            $table->string('NO_REG');
            $table->string('VISUS_OD')->nullable();
            $table->string('VISUS_OS')->nullable();
            $table->string('ADD_OD')->nullable();
            $table->string('ADD_OS')->nullable();
            $table->string('NCT_TOD')->nullable();
            $table->string('NCT_TOS')->nullable();
            $table->string('CREATE_REFRAKSI');
            $table->string('UPDATE_REFRAKSI')->nullable();
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
        Schema::connection('pku')->dropIfExists('poli_mata_refraksi');
    }
};
