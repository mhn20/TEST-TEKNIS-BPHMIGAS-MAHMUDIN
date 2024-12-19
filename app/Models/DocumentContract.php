<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentContract extends Model
{
    use HasFactory;

    protected $table = "document_contract";

    protected $fillable = [
        'composer_id',
        'no_kontrak',
        'tahunbulan', 'document', 'users_id'
    ];

    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Models\User','users_id','id');
    }
}
