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
            $table->increments('id');
            $table->string('idBuku')->unique()->nullable();
            $table->string('judul');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->string('edisi');
            $table->integer('halaman');
            $table->string('jenis');
            $table->string('isbn')->unique();
            $table->integer('harga');
            $table->enum('sumber', ['pembelian', 'hadiah']);
            $table->enum('kondisi',['Baik', 'Kurang Baik']);
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
