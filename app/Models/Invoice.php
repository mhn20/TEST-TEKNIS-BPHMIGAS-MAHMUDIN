<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoice";

    protected $fillable = [
        'users_id', 'nama', 'negara', 'kota', 'kecamatan', 'kelurahan', 'alamat', 'status', 'bukti_transfer'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User','users_id','id');
    }

}
