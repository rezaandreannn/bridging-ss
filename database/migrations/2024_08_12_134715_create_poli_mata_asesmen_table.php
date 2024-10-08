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
        Schema::connection('pku')->create('poli_mata_asesmen', function (Blueprint $table) {
            $table->id();
            $table->string('NO_REG');
            $table->text('RIWAYAT_SEKARANG')->nullable();
            $table->string('KEADAAN_UMUM')->nullable();
            $table->string('KESADARAN')->nullable();
            $table->string('STATUS_MENTAL')->nullable();
            $table->string('LINGKAR_KEPALA');
            $table->string('STATUS_GIZI')->nullable();
            $table->string('CACAT')->nullable();
            $table->string('ADL')->nullable();
            $table->string('VISUS_OD')->nullable();
            $table->string('VISUS_OS')->nullable();
            $table->string('NCT_TOD')->nullable();
            $table->string('NCT_TOS')->nullable();
            $table->string('REFLEK_CAHAYA')->nullable();
            $table->string('PUPIL')->nullable();
            $table->string('LUMPUH')->nullable();
            $table->string('PUSING')->nullable();
            $table->string('CREATE_BY');
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
        Schema::connection('pku')->dropIfExists('poli_mata_asesmen');
    }
};
