<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = "assets";

    protected $fillable = [
        'users_id',
        'work_id',
        'new_rev',
        'ori_ver',
        'title',
        'iswc',
        'performer',
        'pragita_asset_id',
        'isrc',
        'link_youtube_official',
        'link_youtube_others',
        'link_audio',
        'link_lainnya',
        'lyricist',
        'arrange',
        'publisher',
        'cover_art',
        'notasi',
        'lirik',
        'iskontrak',
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User','users_id','id');
    }
    
}
