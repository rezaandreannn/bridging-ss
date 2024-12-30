<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Membuat tabel 'ok_booking_operasi' di koneksi 'pku'
        Schema::connection('pku')->create('ok_booking_operasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_register');
            $table->string('asal_ruangan');
            $table->string('kode_dokter');
            $table->date('tanggal');
            $table->time('rencana_operasi')->nullable();
            $table->string('jenis_operasi')->nullable();
            $table->boolean('terlaksana')->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            // Kolom foreign key yang merujuk ke 'kode_register' pada tabel 'pendaftaran' di database lain
            // $table->foreign('kode_register')->references('No_Reg')->on('db_rsmm.pendaftaran'); 
            // Untuk foreign key antar-database, kita akan menggunakan query raw, bukan schema builder

            // Foreign key reference menggunakan query raw
            // $table->foreign('ruangan_id')
            //     ->references('id')
            //     ->on('ok_ruangan'); // Nama tabel di db1

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus foreign key menggunakan raw SQL query
        // Schema::connection('pku')->table('ok_booking_operasi', function (Blueprint $table) {
        //     $table->dropForeign(['ruangan_id']);
        // });

        // Menghapus tabel 'ok_booking_operasi' dari koneksi 'pku'
        Schema::connection('pku')->dropIfExists('ok_booking_operasi');
    }
};
