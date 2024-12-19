<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataWebsite;
use App\Models\Slider;

class ContactController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Home";
        $object_data['datawebsite'] = $datawebsite;
        $dataslider =  Slider::orderBy('id','DESC')->get();
        $object_data['dataslider'] = [];
        return view('front.pages.contact',$object_data);
    }

}
