<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $table = 'penerbit';
    protected $fillable = ['nama_penerbit', 'kota',];
    protected $primaryKey = 'id_penerbit';

}
