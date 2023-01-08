<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = ['kode_buku', 'judul', 'id_penulis', 'id_penerbit', 'tahun_terbit', 'edisi', 'halaman', 'id_jenis', 'isbn', 'harga', 'sumber', 'kondisi'];
    protected $primaryKey = 'id_buku';

    // public function Rak()
    // {
    //     return $this->belongsTo(Rak::class);
    // }
}
