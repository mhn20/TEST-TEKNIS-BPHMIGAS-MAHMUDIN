<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "barang";

    protected $fillable = [
        'images','sku', 'nmbarang', 'stok', 'harga', 'berat', 'diskon_percent', 'deskripsi'
    ];

    public $timestamps = true;

}
