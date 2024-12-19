<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";

    protected $fillable = [
        'users_id',
        'barang_id',
        'jumlah'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User','users_id','id');
    }

    public function barang() {
        return $this->belongsTo('App\Models\Barang','barang_id','id');
    }
}
