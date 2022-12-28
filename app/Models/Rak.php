<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $table = 'rak';
    protected $fillable = [
        'nama_rak', 'lokasi_rak', 'id_buku'
    ];
}
