<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = "invoice_detail";

    protected $fillable = [
        'invoice_id', 'barang_id', 'sku', 'nmbarang', 'deskripsi', 'harga', 'berat', 'jumlah', 'diskon', 'ongkir', 'subtotal'
    ];

    public $timestamps = true;

    public function invoice() {
        return $this->belongsTo('App\Models\Invoice','invoice_id','id');
    }
    public function barang() {
        return $this->belongsTo('App\Models\Barang','barang_id','id');
    }


}
