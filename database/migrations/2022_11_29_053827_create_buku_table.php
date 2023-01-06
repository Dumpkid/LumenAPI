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
        Schema::create('buku', function (Blueprint $table){
            $table->increments('id_buku');
            $table->string('kode_buku')->unique()->notnull();
            $table->string('judul');
            $table->integer('id_penulis');
            $table->integer('id_penerbit');
            $table->year('tahun_terbit');
            $table->string('edisi');
            $table->integer('halaman');
            $table->integer('id_jenis');
            $table->string('isbn')->unique();
            $table->integer('harga');
            $table->enum('sumber', ['Pembelian', 'Hadiah']);
            $table->enum('kondisi',['Baik', 'Kurang Baik']);
            $table->integer('id_pinjam');
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
        Schema::dropIfExists('buku');
    }
};
