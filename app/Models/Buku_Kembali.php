<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku_Kembali extends Model
{
    protected $table = 'buku_kembali';
    protected $fillable = ['id_anggota', 'id_buku', 'tgl_pengembalian', 'telat_kembali', 'denda', 'id_petugas'];
    protected $primaryKey = 'id_kembali';

}
