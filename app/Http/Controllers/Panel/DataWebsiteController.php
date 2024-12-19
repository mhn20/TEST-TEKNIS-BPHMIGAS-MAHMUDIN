<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;

class DataWebsiteController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Data Website";
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.pages.data-website.form',$object_data);
    }

    public function update(Request $req){
        $object_data = [
            'title' => $req->title, 'meta' => $req->meta, 'telp' => $req->telp, 'alamat' => $req->alamat, 'footer' => $req->footer, 'about' => $req->about, 'term_condition' => $req->term_condition
        ];
        $save_icon = null;
        try {
            $required_ext = 'jpg,jpeg,png,ico';
            if($req->hasFile('icon')) {
                if (str_contains($required_ext, @$req->icon->extension())) { 
                    $name_icon = strtolower('icon_image_'.time().'.'.@$req->icon->extension());  
                    $validate_icon = $req->validate([
                        'icon' => 'max:500',
                    ]);
                    $req->icon->move(public_path('upload/data_website'), $name_icon);
                    $save_icon = '/upload/data_website/'.$name_icon;
                    $object_data['icon'] = $save_icon;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'Icon Harus format :'.$required_ext
                    ]);
                }
            }
        } catch (\Exception $e_icon) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 500kb'
            ]);
        }
        DataWebsite::where('id',1)->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_icon' => @$save_icon
        ]);
        
    }
}
