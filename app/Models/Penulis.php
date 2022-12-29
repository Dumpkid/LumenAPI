<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    protected $table = 'penulis';
    protected $fillable = ['nama_penulis',];
    protected $primaryKey = 'id_penulis';

}
