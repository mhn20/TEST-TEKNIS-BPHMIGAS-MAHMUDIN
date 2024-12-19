<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\Asset;
use App\Models\User;

class AssetController extends Controller
{
    public function index(Request $req){
        $is_admin = session()->get('login_panel')['is_admin'];
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Data Asset";
        $object_data['datawebsite'] = $datawebsite;
        
        if(!$req->get('action')){
            if($is_admin){
                $users_id = $req->get('users_id');
                if($users_id){
                    $datauser = User::where('id',$users_id)->first();
                    if($datauser){
                        $object_data['datauser'] = $datauser;
                        if(!$req->get('action')){
                            return view('panel.pages.asset.index',$object_data);
                        }
                    }else{
                        toastr()->error('Data Asset Tidak Ditemukan');
                        return redirect()->route('panel.asset');
                    }
                }
                if(!$req->get('action')){
                    $object_data['page_title'] = "Data Composer";
                    return view('panel.pages.users.index',$object_data);
                }
            }else{
                $datauser = User::where('email',session()->get('login_panel')['email'])->first();
                return view('panel.pages.asset.index',$object_data);
            }
        }else{
            $users_id = $req->get('users_id');
            $datauser = User::where('id',$users_id)->first();
            $object_data['datauser'] = $datauser;
        }


        if($req->get('action')=='tambah'){
            return view('panel.pages.asset.tambah',$object_data);
        }

        if($req->get('action')=='preview' or $req->get('action')=='edit'){           
            $dataaset_edit = new Asset;
            // if($is_admin){
            //     $dataaset_edit = $dataaset_edit->where('users_id',@$datauser->id);
            // }
            $dataaset_edit = $dataaset_edit->where('id',$req->get('id'))->first();
            if(!$dataaset_edit){
                toastr()->error('Data Asset Tidak Ditemukan');
                return redirect()->route('panel.asset');
            }
            $object_data['dataaset'] = $dataaset_edit;

            if($req->get('action') == 'preview'){
                return view('panel.pages.asset.preview',$object_data);
            }

            return view('panel.pages.asset.edit',$object_data);
        }
    }

    public function postData(Request $req){
        
        $is_admin = session()->get('login_panel')['is_admin'];

        if($is_admin){
            $datauser = User::where('id',$req->users_id)->first();
        }else{
            $datauser = User::where('email',session()->get('login_panel')['email'])->first();
        }

        $object_data = [
            'users_id' => $datauser->id,
            'new_rev' => $req->new_rev,
            'ori_ver' => $req->ori_ver,
            'title' => $req->title,
            'performer' => $req->performer,
            'iswc' => $req->iswc,
            'notasi' => $req->notasi?1:0,
            'lirik' => $req->lirik?1:0,
            'iskontrak' => 0
        ];
        
        if($req->isrc){
            $object_data['isrc'] = $req->isrc;
        }
        if($req->link_youtube_official){
            $object_data['link_youtube_official'] = $req->link_youtube_official;
        }
        if($req->link_youtube_others){
            $object_data['link_youtube_others'] = $req->link_youtube_others;
        }
        if($req->link_audio){
            $object_data['link_audio'] = $req->link_audio;
        }
        if($req->link_lainnya){
            $object_data['link_lainnya'] = $req->link_lainnya;
        }


        if($is_admin){
            if($req->pragita_asset_id){
                $object_data['pragita_asset_id'] = $req->pragita_asset_id;
            }
        }

        $save_cover_art = null;
        try {
            $required_ext = 'jpg,jpeg,png';
            if($req->hasFile('cover_art')) {
                if (str_contains($required_ext, @$req->cover_art->extension())) { 
                    $name_cover_art = strtolower('c'.time().'.'.@$req->cover_art->extension());  
                    $validate_cover_art = $req->validate([
                        'cover_art' => 'max:1000',
                    ]);
                    $req->cover_art->move(public_path('upload/assets'), $name_cover_art);
                    $save_cover_art = '/upload/assets/'.$name_cover_art;
                    $object_data['cover_art'] = $save_cover_art;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'Cover Art Harus format :'.$required_ext
                    ]);
                }
            }else{
                $datawebsite = DataWebsite::first();
                error_log('icon : '.$datawebsite->icon);
                $object_data['cover_art'] = '/assets/panel/images/composer_sample.jpg';
            }
        } catch (\Exception $e_cover_art) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 1MB'
            ]);
        }

        
        $action_save = Asset::create($object_data);

        if(strlen($datauser->id) == 1){
            $users_id = "0".$datauser->id;
        }else{
            $users_id = $datauser->id;
        }
        $total_aset = Asset::where('users_id',$datauser->id)->count();
        if(strlen($total_aset) == 1){
            $asset_id = "0".$total_aset;
        }else{
            $asset_id = $total_aset;
        }
        Asset::where('id',$action_save->id)->update(['work_id'=>'HYPE'.$users_id.'-'.'ASSET'.$asset_id]);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_cover_art' => @$save_cover_art
        ]);
        
    }

    public function updatePragitaAssetID(Request $req, $id){
        $object_data = [];

        $is_admin = session()->get('login_panel')['is_admin'];
        if($is_admin!=1){
            $object_data['status'] = 500;
            $object_data['messages'] = "PGT Asset ID Hanya Bisa Diakses Oleh Admin";
        }else{
            if(!$req->pragita_asset_id){
                $object_data['status'] = 500;
                $object_data['messages'] = "PGT Asset ID Tidak Boleh Kosong";
            }else{
                $cekdata = Asset::where('id','<>',$id)->where('pragita_asset_id',$req->pragita_asset_id)->count();
                if($cekdata > 0){
                    $object_data['status'] = 500;
                    $object_data['messages'] = "PGT Asset ID Sudah Tersedia";
                }else{
                    Asset::where('id',$id)->update(['pragita_asset_id'=>$req->pragita_asset_id]);
                    $object_data['status'] = 200;
                    $object_data['messages'] = "Save Successfull";
                }
            }
        }
        return response()->json($object_data);
    }

    public function data(Request $req){

        $limit = $req->get('limit',10);

        $is_admin = session()->get('login_panel')['is_admin'];

        if($is_admin){
            $datauser = User::where('id',$req->get('users_id'))->first();
        }else{
            $datauser = User::where('email',session()->get('login_panel')['email'])->first();
        }

        $search = $req->get('search');

        $dataset = Asset::with('user');

        $dataset = $dataset->where('users_id',$datauser->id);

        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orWhere('work_id','LIKE','%'.$search.'%')->orWhere('title','LIKE','%'.$search.'%')
                    ->orWhere('performer','LIKE','%'.$search.'%')
                    ->orWhere('isrc','LIKE','%'.$search.'%')
                    ->orWhere('link_youtube_official','LIKE','%'.$search.'%')
                    ->orWhere('link_youtube_others','LIKE','%'.$search.'%');
            });
        }

        $orderby = $req->get('orderby');

        if($orderby == 'terbaru'){
            $dataset = $dataset->orderBy('id','DESC');
        }else{
            $dataset = $dataset->orderBy('id','ASC');
        }

        $dataset = $dataset->paginate($limit);

        return response()->json($dataset);

    }

    public function getContent(Request $req, $id){
        $dataset = Article::where('id',$id)->first();
        return response()->json($dataset);
    }

    public function editData(Request $req, $id){
        
        $datauser = User::where('email',session()->get('login_panel')['email'])->first();

        $object_data = [
            'new_rev' => $req->new_rev,
            'ori_ver' => $req->ori_ver,
            'title' => $req->title,
            'performer' => $req->performer,
            'iswc' => $req->iswc,
            'notasi' => $req->notasi?1:0,
            'lirik' => $req->lirik?1:0,
            'iskontrak' => 0
        ];

        if($req->isrc){
            $object_data['isrc'] = $req->isrc;
        }
        if($req->link_youtube_official){
            $object_data['link_youtube_official'] = $req->link_youtube_official;
        }
        if($req->link_youtube_others){
            $object_data['link_youtube_others'] = $req->link_youtube_others;
        }
        if($req->link_audio){
            $object_data['link_audio'] = $req->link_audio;
        }
        if($req->link_lainnya){
            $object_data['link_lainnya'] = $req->link_lainnya;
        }

        $is_admin = session()->get('login_panel')['is_admin'];

        if($is_admin){
            if($req->pragita_asset_id){
                $object_data['pragita_asset_id'] = $req->pragita_asset_id;
            }
        }

        $save_cover_art = null;
        try {
            $required_ext = 'jpg,jpeg,png';
            if($req->hasFile('cover_art')) {
                if (str_contains($required_ext, @$req->cover_art->extension())) { 
                    $name_cover_art = strtolower('c'.time().'.'.@$req->cover_art->extension());  
                    $validate_cover_art = $req->validate([
                        'cover_art' => 'max:500',
                    ]);
                    $req->cover_art->move(public_path('upload/assets'), $name_cover_art);
                    $save_cover_art = '/upload/assets/'.$name_cover_art;
                    $object_data['cover_art'] = $save_cover_art;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'Cover Art Harus format :'.$required_ext
                    ]);
                }
            }
        } catch (\Exception $e_cover_art) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 500kb'
            ]);
        }
        
        Asset::where('id',$id)->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_cover_art' => @$save_cover_art
        ]);
        
    }

    public function deleteData(Request $req, $id){
        $object_data = [];
        $is_admin = session()->get('login_panel')['is_admin'];
        if(!$is_admin){
            $object_data['status'] = 500;
            $object_data['messages'] = "Hanya Dapat Diakses Oleh Admin";
            return response()->json($object_data);
        }
        // $cekdata = Asset::where('id',$id)->where('iskontrak',1)->count();
        // if($cekdata > 0){
        //     $object_data['status'] = 500;
        //     $object_data['messages'] = "Asset Utama Kontrak Tidak Dapat Dihapus!";
        //     return response()->json($object_data);
        // }
        Asset::where('id',$id)->delete();
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

}
