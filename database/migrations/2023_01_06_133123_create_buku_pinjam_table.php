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
        Schema::create('buku_pinjam', function (Blueprint $table) {
            $table->increments('id_pinjam');
            $table->integer('id_anggota');
            $table->integer('id_buku');
            $table->date('tgl_pinjam');
            $table->integer('lama_pinjam');
            $table->date('tgl_kembali');
            $table->integer('id_petugas');
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
        Schema::dropIfExists('buku_pinjam');
    }
};
