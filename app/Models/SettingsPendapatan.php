<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsPendapatan extends Model
{
    use HasFactory;

    protected $table = "settings_pendapatan";

    protected $fillable = [
        'management_fee_percent',  'pph23_percent', 'npwp_percent', 'nppn_percent'
    ];

    public $timestamps = true;
}
