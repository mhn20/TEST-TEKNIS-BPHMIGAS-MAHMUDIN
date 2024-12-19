<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\DataWebsite;
use Exception;

// use Maatwebsite\Excel\Facades\Excel;
// use App\Imports\BarangImport;


class BarangController extends Controller
{
    public function index(Request $req){
        $object_data = [];
        $object_data['page_title'] = "Data Barang";
        $datawebsite = DataWebsite::first();
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.pages.barang.index',$object_data);
    }

    public function data(Request $req){
        date_default_timezone_set('Asia/Jakarta');
        $limit = $req->get('limit',25);
        $page = $req->get('page',1);
        $dataset = Barang::orderBy('id','desc');

        $search = $req->get('search');
        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orwhere('sku','LIKE','%'.$search.'%');
                $query->orwhere('nmbarang','LIKE','%'.$search.'%');
                $query->orwhere('deskripsi','LIKE','%'.$search.'%');
            });
        }

        $dataset = $dataset->paginate($limit);
        return response()->json($dataset);
    }

    public function postData(Request $req){

        $level = session()->get('login_panel')['level'];
        if($level != 'admin'){
            return response()->json([
                'status' => 500, 'messages' => 'Hanya   Dapat Diakses Oleh Admin'
            ]);
        }

        $object_data = [
            'sku' => $req->sku, 'nmbarang' => $req->nmbarang, 'stok' => $req->stok, 'harga' => str_replace('.','',$req->harga), 'berat' => $req->berat, 'diskon_percent' => $req->diskon_percent, 
            'deskripsi' => $req->deskripsi
        ];

        try {
            $required_ext = 'jpg,jpeg,png';
            if($req->hasFile('images')) {
                if (str_contains($required_ext, @$req->images->extension())) { 
                    $name_images = strtolower('images_'.time().'.'.@$req->images->extension());  
                    $validate_images = $req->validate([
                        'images' => 'max:2000',
                    ]);
                    $req->images->move(public_path('upload/barang/public'), $name_images);
                    $save_images = '/upload/barang/public/'.$name_images;
                    $object_data['images'] = $save_images;                   
                }else{ 
                    return response()->json([
                        'status' => 500, 'messages' => 'images Harus format :'.$required_ext
                    ]);
                }
            }else{
                $save_images = '/upload/barang/sample/sample.jpg';
                $object_data['images'] = $save_images;
            }
        } catch (\Exception $e_images) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 2MB'
            ]);
        }


        Barang::create($object_data);

        $object_data['status'] = 200;
        $object_data['messages'] = "Save Successfull";

        return response()->json($object_data);
        
    }

    public function editData(Request $req, $id){

        $level = session()->get('login_panel')['level'];
        if($level != 'admin'){
            return response()->json([
                'status' => 500, 'messages' => 'Hanya   Dapat Diakses Oleh Admin'
            ]);
        }

        $object_data = [
            'sku' => $req->sku, 'nmbarang' => $req->nmbarang, 'stok' => $req->stok, 'harga' => str_replace('.','',$req->harga), 'berat' => $req->berat, 'diskon_percent' => $req->diskon_percent, 
            'deskripsi' => $req->deskripsi
        ];

        try {
            $required_ext = 'jpg,jpeg,png';
            if($req->hasFile('images')) {
                if (str_contains($required_ext, @$req->images->extension())) { 
                    $name_images = strtolower('images_'.time().'.'.@$req->images->extension());  
                    $validate_images = $req->validate([
                        'images' => 'max:2000',
                    ]);
                    $req->images->move(public_path('upload/barang/images'), $name_images);
                    $save_images = '/upload/barang/images/'.$name_images;
                    $object_data['images'] = $save_images;                   
                }else{ 
                    return response()->json([
                        'status' => 500, 'messages' => 'images Harus format :'.$required_ext
                    ]);
                }
            }
        } catch (\Exception $e_images) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 2MB'
            ]);
        }


        Barang::where('id',$id)->update($object_data);

        $object_data['status'] = 200;
        $object_data['messages'] = "Save Successfull";

        return response()->json($object_data);
        
    }

    public function deleteData(Request $req, $id){

        $level = session()->get('login_panel')['level'];
        if($level != 'admin'){
            return response()->json([
                'status' => 500, 'messages' => 'Hanya   Dapat Diakses Oleh Admin'
            ]);
        }
        Barang::where('id',$id)->delete();
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

    public function uploadDataExcel(Request $req){

        $level = session()->get('login_panel')['level'];
        if($level != 'admin'){
            return response()->json([
                'status' => 500, 'messages' => 'Hanya   Dapat Diakses Oleh Admin'
            ]);
        }

        $save_document_excel = null;
        $name_document_excel = null;
        try {
            $path = $req->file('document_excel')->store('uploads');
            $csvData = [];
            if (($handle = fopen(storage_path("app/{$path}"), 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $csvData[] = $data;
                }
            }

            $json = [];
            for($key=1;$key<=count($csvData)-1;$key++){
                $getcolumn = $csvData[$key];
                $save_images = '/upload/barang/sample/sample.jpg';
                Barang::create([
                    'images' => $save_images,
                    'sku' => $getcolumn[0],
                    'nmbarang' => $getcolumn[1],
                    'stok' => $getcolumn[2],
                    'harga' => $getcolumn[3],
                    'berat' => $getcolumn[4],
                    'diskon_percent' => $getcolumn[5],
                    'deskripsi' => $getcolumn[6]
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500, 'messages' => 'File Excel Tidak Sesuai Format'.$e
            ]);
        }


        return response()->json([
            'status' => 200, 'messages' => 'Save is Successfull'
        ]);

    }

}
