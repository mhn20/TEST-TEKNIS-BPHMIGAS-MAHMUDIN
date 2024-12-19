<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $table = "artists";

    protected $fillable = [
        'assets_id',
        'artist_name',
        'url'
    ];

    public $timestamps = true;

    public function asset() {
        return $this->belongsTo('App\Models\Asset','assets_id','id');
    }
    
}
