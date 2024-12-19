<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataWebsite extends Model
{
    use HasFactory;
    protected $table = 'data_website';

    protected $fillable = [
        'title',
        'meta',
        'telp',
        'alamat',
        'footer',
        'icon', 'about', 'term_condition'
    ];
}
