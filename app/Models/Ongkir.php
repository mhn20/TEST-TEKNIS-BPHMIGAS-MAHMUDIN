<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    protected $table = "ongkir";

    protected $fillable = [
        'subdistrict_id', 'province_id', 'province', 'city_id', 'city', 'type', 'subdistrict_name', 'service', 'description', 'etd', 'ongkir'
    ];

    public $timestamps = true;

}
