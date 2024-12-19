<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoice";

    protected $fillable = [
        'users_id', 'nama', 'negara', 'province', 'kota', 'kecamatan', 'invoice', 'ongkir' ,'alamat', 'status', 'bukti_transfer'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User','users_id','id');
    }

}
