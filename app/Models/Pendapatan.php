<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $table = "pendapatan";

    protected $fillable = [
        'pragita_composer_id','users_id', 'tahunbulan', 'total_gross_royalti', 'management_fee_percent', 'management_fee', 'gross_royalti', 'pph23_percent', 'pph23', 'dokumen_pph23','npwp', 'nppn_percent', 'nppn', 'total_net_royalti', 'keterangan'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User','users_id','id');
    }
}
