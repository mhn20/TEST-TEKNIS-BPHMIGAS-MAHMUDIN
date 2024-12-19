<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\Pendapatan;
use App\Models\SettingsPendapatan;

class SettingsPendapatanController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Setting Pendapatan";
        $object_data['datawebsite'] = $datawebsite;
        $dataset = SettingsPendapatan::first();
        $object_data['dataset'] = $dataset;
        return view('panel.pages.settings-pendapatan.form',$object_data);
    }

    public function update(Request $req){
        $is_admin = session()->get('login_panel')['is_admin'];
        if($is_admin != 1){
            return response()->json([
                'status' => 500, 'messages' => 'Hanya Dapat Diakses Oleh Admin'
            ]);
        }

        $object_data = [
            'management_fee_percent' => $req->management_fee_percent,
            'pph23_percent' => $req->pph23_percent,
            'npwp_percent' => $req->npwp_percent,
            'nppn_percent' => $req->nppn_percent
        ];

        $dataset = new Pendapatan;
        if($dataset->count() > 0){
            SettingsPendapatan::where('id',1)->update($object_data);
        }else{
            SettingsPendapatan::create($object_data);
        }

        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull'
        ]);
        
    }
}
