<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    protected $table = 'katalog';
    protected $fillable = ['id_buku', 'id_pinjam', 'id_rak'];
    protected $primaryKey = 'id_katalog';

}
