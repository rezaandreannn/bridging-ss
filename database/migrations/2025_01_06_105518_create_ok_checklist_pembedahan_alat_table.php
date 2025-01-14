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
        Schema::connection('pku')->create('ok_checklist_pembedahan_alat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('mata_pisau');
            $table->string('mata_pisau_tambah');
            $table->string('mata_pisau_total');
            $table->string('jarum');
            $table->string('jarum_tambah');
            $table->string('jarum_total');
            $table->string('kassa_operasi');
            $table->string('kassa_operasi_tambah');
            $table->string('kassa_operasi_total');
            $table->string('roll_kassa');
            $table->string('roll_kassa_tambah');
            $table->string('roll_kassa_total');
            $table->string('roll_tampon');
            $table->string('roll_tampon_tambah');
            $table->string('roll_tampon_total');
            $table->string('depper');
            $table->string('depper_tambah');
            $table->string('depper_total');
            $table->string('pincet');
            $table->string('pincet_tambah');
            $table->string('pincet_total');
            $table->string('gunting');
            $table->string('gunting_tambah');
            $table->string('gunting_total');
            $table->string('klem_arteri');
            $table->string('klem_arteri_tambah');
            $table->string('klem_arteri_total');
            $table->string('klem_jaringan');
            $table->string('klem_jaringan_tambah');
            $table->string('klem_jaringan_total');
            $table->string('klem_cuci');
            $table->string('klem_cuci_tambah');
            $table->string('klem_cuci_total');
            $table->string('doek_klem');
            $table->string('doek_klem_tambah');
            $table->string('doek_klem_total');
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
        Schema::connection('pku')->dropIfExists('ok_checklist_pembedahan_alat');
    }
};
