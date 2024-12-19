<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\DataWebsite;
use Exception;

// use Maatwebsite\Excel\Facades\Excel;
// use App\Imports\BarangImport;


class InvoiceController extends Controller
{
    public function index(Request $req){
        $object_data = [];
        $object_data['page_title'] = "Data Invoice";
        $datawebsite = DataWebsite::first();
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.pages.invoice.index',$object_data);
    }

    public function detailInvoice(Request $req, $id){
        $object_data = ['id'=>$id];
        $object_data['page_title'] = "Data Invoice";
        $datawebsite = DataWebsite::first();
        $object_data['datawebsite'] = $datawebsite;
        $datainvoice = Invoice::selectRaw("
            invoice.*,
            TIMESTAMPDIFF(HOUR, CONVERT_TZ(NOW(), '+00:00', '+07:00'), invoice.created_at)+1 AS selisih_jam,
            CASE WHEN TIMESTAMPDIFF(HOUR, CONVERT_TZ(NOW(), '+00:00', '+07:00'), invoice.created_at)+1 > 24 THEN 
                -1
            ELSE
                invoice.status
            END AS status,
            CASE WHEN TIMESTAMPDIFF(HOUR, CONVERT_TZ(NOW(), '+00:00', '+07:00'), invoice.created_at)+1 > 24 THEN 
                'Pesanana Dibatalkan'
            ELSE
                CASE WHEN invoice.status = 1 THEN 'Menunggu Konfirmasi CSL1' WHEN invoice.status = 2 THEN 'Sudah Terkonfirmasi' WHEN invoice.status = 3 THEN 'Pesanan Dikirim' WHEN invoice.status = 4 THEN 'Pesanan Sudah Sampai Oleh Penerima' ELSE 'Belum Terbayar' END
            END AS labelstatus
        ")->with('user')->where('id',$id);
        $vdatainvoice = $datainvoice->first();
        if(!$vdatainvoice){
            return response()->json([
                'status' => '404', 'Messages' => 'Invoice Tidak Ditemukan'
            ]);
        }

        $object_data['datainvoice'] = $vdatainvoice;
        
        $datainvoicedetail = InvoiceDetail::where('invoice_id',$vdatainvoice->id);
        $object_data['datainvoicedetail'] = $datainvoicedetail->get();
        $object_data['subtotal'] = $datainvoicedetail->sum('subtotal');
        $object_data['total'] = $datainvoicedetail->sum('subtotal')-$vdatainvoice->ongkir;
        return view('panel.pages.invoice.detail',$object_data);
    }

    public function data(Request $req){
        date_default_timezone_set('Asia/Jakarta');
        $limit = $req->get('limit',25);
        $page = $req->get('page',1);
        $dataset = Invoice::selectRaw("
            invoice.*,
            TIMESTAMPDIFF(HOUR, CONVERT_TZ(NOW(), '+00:00', '+07:00'), invoice.created_at)+1 AS selisih_jam,
            CASE WHEN TIMESTAMPDIFF(HOUR, CONVERT_TZ(NOW(), '+00:00', '+07:00'), invoice.created_at)+1 > 24 THEN 
                -1
            ELSE
                invoice.status
            END AS status,
            CASE WHEN TIMESTAMPDIFF(HOUR, CONVERT_TZ(NOW(), '+00:00', '+07:00'), invoice.created_at)+1 > 24 THEN 
                'Pesanana Dibatalkan'
            ELSE
                CASE WHEN invoice.status = 1 THEN 'Menunggu Konfirmasi CSL1' WHEN invoice.status = 2 THEN 'Sudah Terkonfirmasi' WHEN invoice.status = 3 THEN 'Pesanan Dikirim' WHEN invoice.status = 4 THEN 'Pesanan Sudah Sampai Oleh Penerima' ELSE 'Belum Terbayar' END
            END AS labelstatus
        ")->with('user')->orderBy('id','desc');

        $search = $req->get('search');
        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orwhereHas('user',function($query) use ($search){
                    $query->where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%');
                });
                $query->orwhere('negara','LIKE','%'.$search.'%');
                $query->orwhere('kota','LIKE','%'.$search.'%');
                $query->orwhere('kecamatan','LIKE','%'.$search.'%');
                $query->orwhere('kelurahan','LIKE','%'.$search.'%');
                $query->orwhere('alamat','LIKE','%'.$search.'%');
            });
        }

        $dataset = $dataset->paginate($limit);

        foreach($dataset as $rowindex){
            if(strlen($rowindex->id) == 1){
                $noinvoice = "000".$rowindex->id;
            }else if(strlen($rowindex->id) == 2){
                $noinvoice = "00".$rowindex->id;
            }else if(strlen($rowindex->id) == 3){
                $noinvoice = "0".$rowindex->id;
            }else{
                $noinvoice = $rowindex->id;
            }
            $rowindex['noinvoice'] = 'INV-'.$noinvoice;
            $datadetail = InvoiceDetail::where('invoice_id',$rowindex->id);
            $rowindex['jumlahitem'] = $datadetail->count();
            $rowindex['subtotal'] = $datadetail->sum('subtotal');
        }

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

    public function uploadBuktiTransfer(Request $req, $id){

        $object_data = ['status'=>1];

        try {
            $required_ext = 'jpg,jpeg,png,pdf';
            if($req->hasFile('bukti_transfer')) {
                if (str_contains($required_ext, @$req->bukti_transfer->extension())) { 
                    $name_bukti_transfer = strtolower('bukti_transfer_'.time().'.'.@$req->bukti_transfer->extension());  
                    $validate_bukti_transfer = $req->validate([
                        'bukti_transfer' => 'max:2000',
                    ]);
                    $req->bukti_transfer->move(public_path('upload/invoice/bukti_transfer'), $name_bukti_transfer);
                    $save_bukti_transfer = '/upload/barang/bukti_transfer/'.$name_bukti_transfer;
                    $object_data['bukti_transfer'] = $save_bukti_transfer;                   
                }else{ 
                    return response()->json([
                        'status' => 500, 'messages' => 'bukti_transfer Harus format :'.$required_ext
                    ]);
                }
            }
        } catch (\Exception $e_bukti_transfer) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 2MB'
            ]);
        }


        Invoice::where('id',$id)->where('status',0)->update($object_data);

        $object_data['status'] = 200;
        $object_data['messages'] = "Save Successfull";

        return response()->json($object_data);
        
    }

    public function verifikasi(Request $req, $id){
        
        $datainvoicedetaail = InvoiceDetail::where('invoice_id',$id)->whereHas('invoice',function($query){
            $query->where('status',1);
        })->get();
        if($datainvoicedetaail){
            if($req->status == 2){
                foreach($datainvoicedetaail as $rowindex){
                    $databarang = Barang::where('id',$rowindex->barang_id);
                    $vdatabarang = $databarang->first();
                    $stok = $vdatabarang->stok-1;
                    $databarang->update([
                        'stok' => $stok
                    ]);
                    error_log('stok berkurang');
                }
            }
        }
        Invoice::where('id',$id)->update([
            'status' => $req->status
        ]);
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Save Successfull";
        return response()->json($object_data);
    }

}
