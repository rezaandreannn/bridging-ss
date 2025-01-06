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
            $table->string('jarum');
            $table->string('roll_kassa');
            $table->string('roll_tampon');
            $table->string('depper');
            $table->string('pincet');
            $table->string('gunting');
            $table->string('klem_arteri');
            $table->string('klem_jaringan');
            $table->string('klem_cuci');
            $table->string('doek_klem');
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
