<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\DocumentContract;
use App\Models\User;


class DocumentContractController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Data Document Contract";
        $object_data['datawebsite'] = $datawebsite;
        $databulan = [
            ['key' => '01', 'value' => 'Januari'],
            ['key' => '02', 'value' => 'Februari'],
            ['key' => '03', 'value' => 'Maret'],
            ['key' => '04', 'value' => 'April'],
            ['key' => '05', 'value' => 'Mei'],
            ['key' => '06', 'value' => 'Juni'],
            ['key' => '07', 'value' => 'Juli'],
            ['key' => '08', 'value' => 'Agustus'],
            ['key' => '09', 'value' => 'September'],
            ['key' => '10', 'value' => 'Oktober'],
            ['key' => '11', 'value' => 'November'],
            ['key' => '12', 'value' => 'Desember']
        ];
        $object_data['databulan'] = $databulan;
        $datatahun = [];
        for($i=date('Y');$i>=date('Y')-4;$i--){
            $datatahun[] = [
                'key' => $i
            ];
        }
        $object_data['datatahun'] = $datatahun;
        $dataset_user = User::where('is_admin',false);
        $dataset_user = $dataset_user->get();
        $object_data['dataset_user'] = $dataset_user;
        return view('panel.pages.document-contract.index',$object_data);
    }

    public function getDataUsers(Request $req){
        $q = $req->get('q');
        $dataset = User::where('is_admin',false);
        if($q){
            $dataset = $dataset->where(function($query) use ($q){
                $query->orWhere('email','LIKE','%'.$q.'%')->orWhere('name','LIKE','%'.$q.'%')->orWhere('alias','LIKE','%'.$q.'%');
            });
        }
        $dataset = $dataset->get();
        return response()->json($dataset);
    }

    public function postData(Request $req){

        $sess_email = session()->get('login_panel')['email'];
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        
        $datauser = new User;
        if($sess_is_admin){
            $datauser = $datauser->where('id',$req->users_id);
        }else{
            $datauser = $datauser->where('email',$sess_email);
        }
        $datauser = $datauser->first();

        $cek_kontrak = DocumentContract::where('no_kontrak',$req->no_kontrak)->first();
        if($cek_kontrak){
            return response()->json([
                'status' => 500, 'messages' => 'No Kontrak Is Available'
            ]);
        }

        $object_data = [
            'users_id' => $datauser->id,
            'composer_id' => $req->composer_id, 'no_kontrak' => $req->no_kontrak, 'tahunbulan' => $req->tahun.$req->bulan
        ];

        $save_document = null;
        try {
            $required_ext_document = 'pdf,doc,docx';
            if($req->hasFile('document')) {
                if (str_contains($required_ext_document, @$req->document->extension())) { 
                    $name_document = strtolower('document_contract_'.time().'.'.@$req->document->extension());  
                    $validate_document = $req->validate([
                        'document' => 'max:10000',
                    ]);
                    $req->document->move(public_path('upload/users/document-contract'), $name_document);
                    $save_document = '/upload/users/document-contract/'.$name_document;
                    $object_data['document'] = $save_document;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'document Harus format :'.$required_ext_document
                    ]);
                }
            }
        } catch (\Exception $e_avatar) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 10MB'
            ]);
        }

        
        DocumentContract::create($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_document' => @$save_document
        ]);
        
    }

    function getMonth($bulan,$tahun){
        $databulan = [
            ['key' => '01', 'value' => 'Januari'],
            ['key' => '02', 'value' => 'Februari'],
            ['key' => '03', 'value' => 'Maret'],
            ['key' => '04', 'value' => 'April'],
            ['key' => '05', 'value' => 'Mei'],
            ['key' => '06', 'value' => 'Juni'],
            ['key' => '07', 'value' => 'Juli'],
            ['key' => '08', 'value' => 'Agustus'],
            ['key' => '09', 'value' => 'September'],
            ['key' => '10', 'value' => 'Oktober'],
            ['key' => '11', 'value' => 'November'],
            ['key' => '12', 'value' => 'Desember']
        ];
        $getdata = '-';
        foreach($databulan as $rowindex){
            if($rowindex['key'] == $bulan){
                $getdata = $rowindex['value']." ".$tahun;
            }
        }
        return $getdata;
    }

    public function data(Request $req){

        $sess_email = session()->get('login_panel')['email'];
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        $search = $req->get('search');

        $dataset = DocumentContract::with('user');

        $datauser = User::where('email',$sess_email)->first();
        if($sess_is_admin == false){
            if($datauser){
                $dataset = $dataset->where('users_id',$datauser->id);
            }
        }

        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orWhere('composer_id','LIKE','%'.$search.'%')
                    ->orWhere('no_kontrak','LIKE','%'.$search.'%')
                    ->orWhereHas('user',function($query) use ($search){
                        $query->where('name','LIKE','%'.$search.'%')
                            ->orWhere('email','LIKE','%'.$search.'%')
                            ->orWhere('alias','LIKE','%'.$search.'%');
                    });
            });
        }
        $dataset = $dataset->orderBy('id','DESC');

        $dataset = $dataset->paginate(25);

        foreach($dataset as $rowindex){
            $rowindex['bulan'] = substr($rowindex->tahunbulan,4,2);
            $rowindex['tahun'] = substr($rowindex->tahunbulan,0,4);
            $rowindex['periode'] = $this->getMonth(substr($rowindex->tahunbulan,4,2),substr($rowindex->tahunbulan,0,4));
        }

        return response()->json($dataset);

    }

    public function getContent(Request $req, $id){
        $dataset = Article::where('id',$id)->first();
        return response()->json($dataset);
    }

    public function editData(Request $req, $id){
        $sess_email = session()->get('login_panel')['email'];
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        
        $datauser = new User;
        if($sess_is_admin){
            $datauser = $datauser->where('id',$req->users_id);
        }else{
            $datauser = $datauser->where('email',$sess_email);
        }
        $datauser = $datauser->first();
        
        $cek_kontrak = DocumentContract::where('no_kontrak',$req->no_kontrak)->where('id','<>',$id)->first();
        if($cek_kontrak){
            return response()->json([
                'status' => 500, 'messages' => 'No Kontrak Is Available'
            ]);
        }

        $object_data = [
            'users_id' => $datauser->id,
            'composer_id' => $req->composer_id, 'no_kontrak' => $req->no_kontrak, 'tahunbulan' => $req->tahun.$req->bulan
        ];

        $save_document = null;
        try {
            $required_ext_document = 'pdf,doc,docx';
            if($req->hasFile('document')) {
                if (str_contains($required_ext_document, @$req->document->extension())) { 
                    $name_document = strtolower('document_contract_'.time().'.'.@$req->document->extension());  
                    $validate_document = $req->validate([
                        'document' => 'max:10000',
                    ]);
                    $req->document->move(public_path('upload/users/document-contract'), $name_document);
                    $save_document = '/upload/users/document-contract/'.$name_document;
                    $object_data['document'] = $save_document;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'document Harus format :'.$required_ext_document
                    ]);
                }
            }
        } catch (\Exception $e_avatar) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 10MB'
            ]);
        }
        
        DocumentContract::where('id',$id)->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_document' => @$save_document
        ]);
        
    }

    public function deleteData(Request $req, $id){
        DocumentContract::where('id',$id)->delete();
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

}
