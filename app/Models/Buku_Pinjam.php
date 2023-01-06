<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku_Pinjam extends Model
{
    protected $table = 'buku_pinjam';
    protected $fillable = ['id_anggota', 'id_buku', 'tgl_pinjam', 'lama_pinjam', 'tgl_kembali', 'id_petugas', 'status_pinjam'];
    protected $primaryKey = 'id_pinjam';

}
