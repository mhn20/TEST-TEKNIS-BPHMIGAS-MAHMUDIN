<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataWebsite;
use App\Models\Barang;

class ProdukController extends Controller
{
    public function detail(Request $req, $id){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Detail Produk";
        $object_data['dataslider'] = [];
        $object_data['datawebsite'] = $datawebsite;
        $databarang =  Barang::where('id',$id)->first();
        if(!$databarang){
            toastr()->error('Produk Not Found');
            return redirect()->route('front.home');
        }
        $object_data['databarang'] = $databarang;
        return view('front.pages.produk_detail',$object_data);
    }

}
