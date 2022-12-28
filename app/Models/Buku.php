<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = [
        'kode_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'edisi', 'halaman', 'jenis', 'isbn', 'harga', 'sumber', 'kondisi'
    ];
}
