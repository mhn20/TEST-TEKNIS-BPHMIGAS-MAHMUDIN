<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataWebsite;
use App\Models\Slider;
use App\Models\Barang;

class HomeController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Home";
        $object_data['datawebsite'] = $datawebsite;
        $dataslider =  Slider::orderBy('id','DESC')->get();
        $no = 0;
        foreach($dataslider as $rowindex){
            $rowindex['no'] = $no++;
        }
        $object_data['dataslider'] = $dataslider;
        $databarang =  Barang::orderBy('id','DESC')->get();
        $object_data['databarang'] = $databarang;
        return view('front.pages.home',$object_data);
    }



}
