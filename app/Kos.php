<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $table = 'kos';
    protected $fillable = ['nama_kos', 'harga_kos', 'no_telp', 'tentang_kos', 'gambar_kos'];
}
