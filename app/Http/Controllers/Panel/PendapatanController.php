<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\DocumentContract;
use App\Models\User;
use App\Models\Asset;
use App\Models\Pendapatan;
use App\Models\SettingsPendapatan;
use Illuminate\Support\Facades\Hash;
use DB;
use Mail;
use App\Mail\MailNotify;
use Exception;

class PendapatanController extends Controller
{
    public function index(Request $req){
        $sess_email = session()->get('login_panel')['email'];
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Pendapatan Perbulan";
        $object_data['datawebsite'] = $datawebsite;
        $select_bulan = [
            [
                'key' => '01', 'val' => 'Januari'
            ],[
                'key' => '02', 'val' => 'Februari'
            ],[
                'key' => '03', 'val' => 'Maret'
            ],[
                'key' => '04', 'val' => 'April'
            ],[
                'key' => '05', 'val' => 'Mei'
            ],[
                'key' => '06', 'val' => 'Juni'
            ],[
                'key' => '07', 'val' => 'Juli'
            ],[
                'key' => '08', 'val' => 'Agustus'
            ],[
                'key' => '09', 'val' => 'September'
            ],[
                'key' => '10', 'val' => 'Oktober'
            ],[
                'key' => '11', 'val' => 'November'
            ],[
                'key' => '12', 'val' => 'Desember'
            ]
        ];
        $object_data['select_bulan'] = $select_bulan;

        $action = $req->get('action');
        if($action == 'percomposer'){
            $tahunbulan = $req->get('tahunbulan',date('Ym'));
            $object_data['page_title'] = "Pendapatan Percomposer";
            $object_data['periode'] = 'Periode '.$this->labelPeriode($tahunbulan);
            return view('panel.pages.pendapatan.percomposer',$object_data);
        }
        if($action == 'detailcomposer'){
            $tahunbulan = $req->get('tahunbulan',date('Ym'));
            $object_data['periode'] = 'Periode '.$this->labelPeriode($tahunbulan);
            if($sess_is_admin == 1){
                $object_data['page_title'] = "Pendapatan Detail Composer";
                $datauser = User::where('id',$req->get('users_id'))->first();
                $object_data['users_id'] = $datauser->id;
            }else{
                $object_data['page_title'] = "Pendapatan Composer";
                $datauser = User::where('email',$sess_email)->first();
                $object_data['users_id'] = $datauser->id;
            }
            $object_data['datauser'] = $datauser;
            return view('panel.pages.pendapatan.detail',$object_data);
        }

        return view('panel.pages.pendapatan.perbulan',$object_data);
    }

    function labelPeriode($tahunbulan){
        $tahun = substr($tahunbulan,0,4);
        $bulan = substr($tahunbulan,4,2);
        $label_bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        return $label_bulan[(int)$bulan-1].' '.$tahun;
    }

    public function dataPerbulan(Request $req){

        $limit = $req->get('limit',25);

        $tahun = $req->get('tahun',date('Y'));
        $bulan_awal = $tahun.$req->get('bulan_awal',date('m'));
        $bulan_akhir = $tahun.$req->get('bulan_akhir',date('m'));

        $sess_email = session()->get('login_panel')['email'];
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        
        $search = $req->get('search');


        $dataset = DB::table('periode')->join('pendapatan',function($query) use ($bulan_awal,$bulan_akhir,$tahun,$sess_is_admin,$sess_email){
            $query->on(DB::raw('substr(pendapatan.tahunbulan,5,2)'),'periode.key');
            $query->whereBetween('pendapatan.tahunbulan',[$bulan_awal,$bulan_akhir]);
            if($sess_is_admin != 1){
                $datauser = User::where('email',$sess_email)->first();
                $users_id = $datauser->id;
                $query = $query->where('pendapatan.users_id',$users_id);
            }
        });

        $dataset = $dataset->selectRaw("
            concat($tahun, periode.key) as tahunbulan, 
            sum(ifnull(pendapatan.total_gross_royalti,0)) as total_gross_royalti, 
            sum(ifnull(pendapatan.management_fee,0)) as management_fee, 
            sum(ifnull(pendapatan.gross_royalti,0)) as gross_royalti,  
            sum(ifnull(pendapatan.pph23,0)) as pph23, 
            sum(ifnull(pendapatan.npwp,0)) as npwp, 
            sum(ifnull(pendapatan.nppn,0)) as nppn, 
            sum(ifnull(pendapatan.total_net_royalti,0)) as total_net_royalti
        ");

        $dataset = 

        $dataset = $dataset->groupBy('periode.key');

        if($req->get('orderby') == 'terlama'){
            $dataset = $dataset->orderBy('periode.key','ASC');
        }

        if($req->get('orderby') == 'terbaru'){
            $dataset = $dataset->orderBy('periode.key','DESC');
        }

        $dataset = $dataset->paginate($limit);

        $dataset->getCollection()->transform(function ($rowindex) {
            $rowindex->periode = $this->labelPeriode($rowindex->tahunbulan);
            return $rowindex;
        });


        $rekap = Pendapatan::whereBetween('pendapatan.tahunbulan',[$bulan_awal,$bulan_akhir]);
        if(@$users_id){
            $rekap = $rekap->where('users_id',@$users_id);
        }

        return response()->json([
            'rekap' => [
                'total_gross_royalti' => $rekap->sum('total_gross_royalti'),
                'management_fee' => $rekap->sum('management_fee'),
                'gross_royalti' => $rekap->sum('gross_royalti'),
                'pph23' => $rekap->sum('pph23'),
                'npwp' => $rekap->sum('npwp'),
                'nppn' => $rekap->sum('nppn'),
                'total_net_royalti' => $rekap->sum('total_net_royalti')
            ],
            'table' => $dataset
        ]);


    }


    public function dataPerComposer(Request $req){

        $limit = $req->get('limit',10);

        $komposisi = $req->get('komposisi');

        $tahunbulan = $req->get('tahunbulan',date('Ym'));
        $search = $req->get('search');
        
        $dataset = DB::table('users')->leftjoin('pendapatan',function($query) use ($tahunbulan){
            $query->on('pendapatan.users_id','users.id');
            $query->where('tahunbulan',$tahunbulan);
        });
        
        $sess_email = session()->get('login_panel')['email'];
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        if($sess_is_admin != 1){
            $datauser = User::where('email',$sess_email)->first();
            $users_id = $datauser->id;
            $dataset = $dataset->where('users.id',$users_id);
        }

        $dataset = $dataset->where('is_admin','<>',1);
        $dataset = $dataset->where('isverif',1);
        $dataset = $dataset->where('isverifadmin',1);

        if($komposisi){
            $dataset = $dataset->where(function($query) use ($komposisi){
                $query->orwhere(DB::raw("concat('HYPE',upper(users.id))"),'LIKE','%'.$komposisi.'%');
                $query->orwhere(DB::raw("upper(users.name)"),'LIKE','%'.$komposisi.'%');
            });
        }

        $dataset = $dataset->selectRaw("
            $tahunbulan as tahunbulan, users.id, users.name, 
            sum(ifnull(pendapatan.total_gross_royalti,0)) as total_gross_royalti, 
            sum(ifnull(pendapatan.management_fee,0)) as management_fee, 
            sum(ifnull(pendapatan.gross_royalti,0)) as gross_royalti,  
            sum(ifnull(pendapatan.pph23,0)) as pph23, 
            sum(ifnull(pendapatan.npwp,0)) as npwp, 
            sum(ifnull(pendapatan.nppn,0)) as nppn, 
            sum(ifnull(pendapatan.total_net_royalti,0)) as total_net_royalti
        ");

        $dataset = $dataset->groupBy('tahunbulan','users.id','users.name');

        if ($req->get('orderby') == 'terlama') {
            $dataset = $dataset->orderBy('total_net_royalti', 'ASC');
        }
        
        if ($req->get('orderby') == 'terbaru') {
            $dataset = $dataset->orderBy('total_net_royalti', 'DESC');
        }

        $dataset = $dataset->paginate($limit);

        foreach($dataset as $rowindex){
            $rowindex->periode = $this->labelPeriode($rowindex->tahunbulan);
            if(strlen($rowindex->id) == 1){
                $rowindex->work_id = 'HYPE0'.$rowindex->id;
            }else{
                $rowindex->work_id = 'HYPE'.$rowindex->id;
            }
        }

        $rekap = Pendapatan::where('tahunbulan',$tahunbulan);
        if(@$users_id){
            $rekap = $rekap->where('users_id',@$users_id);
        }

        return response()->json([
            'label_periode' => 'Periode '.$this->labelPeriode($tahunbulan),
            'rekap' => [
                'total_gross_royalti' => $rekap->sum('total_gross_royalti'),
                'management_fee' => $rekap->sum('management_fee'),
                'gross_royalti' => $rekap->sum('gross_royalti'),
                'pph23' => $rekap->sum('pph23'),
                'npwp' => $rekap->sum('npwp'),
                'nppn' => $rekap->sum('nppn'),
                'total_net_royalti' => $rekap->sum('total_net_royalti')
            ],
            'table' => $dataset
        ]);

    }


    public function dataDetailComposer(Request $req){

        $limit = $req->get('limit',10);

        $komposisi = $req->get('komposisi');

        $tahunbulan = $req->get('tahunbulan',date('Ym'));
        $search = $req->get('search');

        $dataset = DB::table('users')->join('pendapatan',function($query) use ($tahunbulan){
            $query->on('pendapatan.users_id','users.id');
            $query->where('tahunbulan',$tahunbulan);
        });

        $sess_email = session()->get('login_panel')['email'];
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        if($sess_is_admin != 1){
            $datauser = User::where('email',$sess_email)->first();
            $users_id = $datauser->id;
            $dataset = $dataset->where('users.id',$users_id);
        }else{
            $users_id = $req->get('users_id');
            $dataset = $dataset->where('users.id',$users_id);
        }

        $dataset = $dataset->where('is_admin','<>',1);
        $dataset = $dataset->where('isverif',1);
        $dataset = $dataset->where('isverifadmin',1);

        if($komposisi){
            $dataset = $dataset->where(function($query) use ($komposisi){
                $query->orwhere(DB::raw("concat('HYPE',upper(users.id))"),'LIKE','%'.$komposisi.'%');
                $query->orwhere(DB::raw("upper(users.name)"),'LIKE','%'.$komposisi.'%');
            });
        }

        $dataset = $dataset->selectRaw("
            pendapatan.id, pendapatan.dokumen_pph23,
            $tahunbulan as tahunbulan, users.pragita_composer_id, users.id as users_id, users.name, 
            ifnull(pendapatan.total_gross_royalti,0) as total_gross_royalti, 
            ifnull(pendapatan.management_fee_percent,0) as management_fee_percent, 
            ifnull(pendapatan.management_fee,0) as management_fee, 
            ifnull(pendapatan.gross_royalti,0) as gross_royalti,  
            ifnull(pendapatan.pph23_percent,0) as pph23_percent, 
            ifnull(pendapatan.pph23,0) as pph23, 
            ifnull(pendapatan.npwp_percent,0) as npwp_percent, 
            pendapatan.isnpwp,
            ifnull(pendapatan.npwp,0) as npwp, 
            ifnull(pendapatan.nppn_percent,0) as nppn_percent, 
            pendapatan.isnppn,
            ifnull(pendapatan.nppn,0) as nppn, 
            ifnull(pendapatan.total_net_royalti,0) as total_net_royalti
        ");

        if ($req->get('orderby') == 'terlama') {
            $dataset = $dataset->orderBy('total_net_royalti', 'ASC');
        }
        
        if ($req->get('orderby') == 'terbaru') {
            $dataset = $dataset->orderBy('total_net_royalti', 'DESC');
        }

        $dataset = $dataset->paginate($limit);

        foreach($dataset as $rowindex){
            $rowindex->periode = $this->labelPeriode($rowindex->tahunbulan);
            if(strlen($rowindex->id) == 1){
                $rowindex->work_id = 'HYPE0'.$rowindex->id;
            }else{
                $rowindex->work_id = 'HYPE'.$rowindex->id;
            }
        }

        $rekap = Pendapatan::where('tahunbulan',$tahunbulan)->where('users_id',$users_id);

        return response()->json([
            'label_periode' => 'Periode '.$this->labelPeriode($tahunbulan),
            'rekap' => [
                'total_gross_royalti' => $rekap->sum('total_gross_royalti'),
                'management_fee' => $rekap->sum('management_fee'),
                'gross_royalti' => $rekap->sum('gross_royalti'),
                'pph23' => $rekap->sum('pph23'),
                'npwp' => $rekap->sum('npwp'),
                'nppn' => $rekap->sum('nppn'),
                'total_net_royalti' => $rekap->sum('total_net_royalti')
            ],
            'table' => $dataset
        ]);


    }

    function updatePercent(Request $req, $id){      
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        if($sess_is_admin != 1){
            return response()->json([
                'status' => 500,  'messages' => 'Hanya Bisa Diakses Oleh Admin'
            ]); 
        }

        error_log('id : '.$id);
        $dataset = Pendapatan::where('id',$id);
        $object_data = [];
        $management_fee_percent = $req->management_fee_percent;
        error_log('management_fee_percent : '.$management_fee_percent);
        if($management_fee_percent){
            $object_data['management_fee_percent'] = $management_fee_percent;
        }
        $pph23_percent = $req->pph23_percent;
        if($pph23_percent){
            $object_data['pph23_percent'] = $pph23_percent;
        }
        $nppn_percent = $req->nppn_percent;
        if($nppn_percent){
            $object_data['nppn_percent'] = $nppn_percent;
        }
        $dataset = $dataset->update($object_data);

        $cekdata = Pendapatan::where('id',$id);

        if($cekdata->count() > 0){
            $getdata = $cekdata->first();
            
            $total_gross_royalti = $getdata->total_gross_royalti;
            $management_fee_percent = $getdata->management_fee_percent/100;

            // save
            $management_fee = $total_gross_royalti*$management_fee_percent;

            // save
            $gross_royalti = $total_gross_royalti-$management_fee;

            $pph23_percent = $getdata->pph23_percent/100;

            // save
            $pph23 = $gross_royalti*$pph23_percent;

            $nppn_percent = $getdata->nppn_percent/100;

            // save
            $nppn = $gross_royalti*$nppn_percent;

            // save
            $total_net_royalti = $gross_royalti-($management_fee+$pph23+$nppn);

            $cekdata->update([
                'management_fee' => $management_fee,
                'gross_royalti' => $gross_royalti,
                'pph23' => $pph23,
                'nppn' => $nppn, 
                'total_net_royalti' => $total_net_royalti
            ]);

        }

        return response()->json([
            'status' => 200,  'messages' => 'Save Successfull'
        ]); 

    }


    function postData(Request $req){
        
        $sess_email = session()->get('login_panel')['email'];    
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        $tahunbulan = $req->tahunbulan;
        if($sess_is_admin == 1){
            $users_id = $req->users_id;
            $datauser = User::where('id',$users_id)->first();
            $pragita_composer_id = @$datauser->pragita_composer_id;
            $isnpwp = $datauser->pragita_composer_id;
        }else{
            $datauser = User::where('email',$sess_email)->first();
            $users_id = $datauser->id;
            $pragita_composer_id = @$datauser->pragita_composer_id;
            $isnpwp = $datauser->pragita_composer_id;
        }
        if(!@$pragita_composer_id){
            return response()->json([
                'status' => 500,  'messages' => 'PGT Composer ID Belum Diinput Oleh Admin'
            ]); 
        }

        $dataset_settings = SettingsPendapatan::where('id',1)->first();
        $total_gross_royalti = str_replace('.','',$req->total_gross_royalti).'.'.$req->pembulat;
        $management_fee_percent = $dataset_settings->management_fee_percent/100;
        $management_fee = $total_gross_royalti*$management_fee_percent;
        $gross_royalti = $total_gross_royalti-$management_fee;
        $pph23_percent = $dataset_settings->pph23_percent/100;
        $pph23 = $gross_royalti*$pph23_percent;
        // $nppn_percent = $dataset_settings->nppn_percent/100;
        // $nppn = $total_gross_royalti*$nppn_percent;
        $nppn_percent = 0;
        $nppn = 0;
        $total_net_royalti = $gross_royalti-($management_fee+$pph23+$nppn);
        
        Pendapatan::create([
            'users_id' => $users_id,
            'tahunbulan' => $tahunbulan,
            'pragita_composer_id' => $pragita_composer_id,
            'total_gross_royalti' => $total_gross_royalti,
            'management_fee_percent' => $dataset_settings->management_fee_percent,
            'management_fee' => $management_fee,
            'gross_royalti' => $gross_royalti,
            'pph23_percent' => $dataset_settings->pph23_percent,
            'pph23' => $pph23,
            'nppn_percent' => 0,
            'nppn' => $nppn,
            'total_net_royalti' => $total_net_royalti
        ]);

        return response()->json([
            'status' => 200,  'messages' => 'Save Successfull'
        ]);  

    }

    function deleteData(Request $req, $id){
        $dataset = Pendapatan::where('id',$id)->delete();
        return response()->json([
            'status' => 200,  'messages' => 'Delete Successfull'
        ]);  
    }


    public function uploadCSV(Request $request)
    {

        $sess_email = session()->get('login_panel')['email'];    
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        if($sess_is_admin != 1){
            return response()->json([
                'status' => 500,  'messages' => 'Hanya Bisa Diakses Oleh Admin'
            ]); 
        }
        $tahunbulan = $request->tahunbulan;
        if($sess_is_admin == 1){
            $users_id = $request->users_id;
            $datauser = User::where('id',$users_id)->first();
            $pragita_composer_id = @$datauser->pragita_composer_id;
            $isnpwp = $datauser->pragita_composer_id;
        }else{
            $datauser = User::where('email',$sess_email)->first();
            $users_id = $datauser->id;
            $pragita_composer_id = @$datauser->pragita_composer_id;
            $isnpwp = $datauser->pragita_composer_id;
        }

        $keterangan = date('YmdHis');

        try{
            // Validasi file
            // $request->validate([
            //     'file' => 'required|mimes:csv,txt|max:2048',
            // ]);

            // Simpan file ke storage
            $path = $request->file('dokumen_csv')->store('uploads');

            // Baca isi file
            $csvData = [];
            if (($handle = fopen(storage_path("app/{$path}"), 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $csvData[] = $data;
                }
                // fclose($handle);
            }

            $json = [];
            for($key=1;$key<=count($csvData)-1;$key++){

                $getcolumn = $csvData[$key];

                $pgt_composer_id = $getcolumn[0];
                $total_gross_royalti = (double)$getcolumn[1];
                $management_fee_percent = (int)$getcolumn[2];
                $management_fee = (double)$getcolumn[3];
                $gross_royalti = (double)$getcolumn[4];
                $pph23_percent = (int)$getcolumn[5];
                $pph23 = (double)$getcolumn[6];
                $total_net_royalti = (double)$getcolumn[7];

                $cek_pgt_composer_id = User::where('pragita_composer_id','LIKE','%'.$pgt_composer_id.'%')->where('id',$users_id)->count();
                error_log('users_id : '.$users_id);
                if($cek_pgt_composer_id == 0){
                    Pendapatan::where('keterangan',$keterangan)->delete();
                    return response()->json([
                        'status' => 500,  'messages' => 'PGT Composer ID Tidak Ditemukan'
                    ]); 
                }else{
                    $json[] = [
                        'pgt_composer_id' => $getcolumn[0],
                        'total_gross_royalti' => (double)$getcolumn[1],
                        'management_fee_percent' => (int)$getcolumn[2],
                        'management_fee' => (double)$getcolumn[3],
                        'gross_royalti' => (double)$getcolumn[4],
                        'pph23_percent' => (int)$getcolumn[5],
                        'pph23' => (double)$getcolumn[6],
                        'total_net_royalti' => (double)$getcolumn[7]
                    ];
    
                    Pendapatan::create([
                        'users_id' => $users_id,
                        'tahunbulan' => $tahunbulan,
                        'pragita_composer_id' => $pgt_composer_id,
                        'total_gross_royalti' => $total_gross_royalti,
                        'management_fee_percent' => $management_fee_percent,
                        'management_fee' => $management_fee,
                        'gross_royalti' => $gross_royalti,
                        'pph23_percent' => $pph23_percent,
                        'pph23' => $pph23,
                        'nppn_percent' => 0,
                        'nppn' => 0,
                        'total_net_royalti' => $total_net_royalti,
                        'keterangan' => $keterangan
                    ]);
                }


            }

            return response()->json([
                'status' => 200,  'messages' => 'Save Successfull'
            ]); 

        } catch (Exception $e) {
            Pendapatan::where('keterangan',$keterangan)->delete();

            return response()->json([
                'status' => 500,  'messages' => 'File CSV Tidak Sesuai Format : '.$e
            ]); 

        }
    }

    public function uploadDokumenPPH23(Request $req, $id)
    {

        $sess_email = session()->get('login_panel')['email'];    
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        if($sess_is_admin != 1){
            return response()->json([
                'status' => 500,  'messages' => 'Hanya Bisa Diakses Oleh Admin'
            ]); 
        }

        $object_data = [];
        try {
            $required_ext = 'jpg,jpeg,png,pdf';
            if($req->hasFile('dokumen_pph23')) {
                if (str_contains($required_ext, @$req->dokumen_pph23->extension())) { 
                    $name_images = strtolower('dokumen_pph23_'.time().'.'.@$req->dokumen_pph23->extension());  
                    $validate_images = $req->validate([
                        'dokumen_pph23' => 'max:2000',
                    ]);
                    $req->dokumen_pph23->move(public_path('upload/dokumen_pph23'), $name_images);
                    $save_images = '/upload/dokumen_pph23/'.$name_images;
                    $object_data['dokumen_pph23'] = $save_images;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'Dokumen Pajak Harus format :'.$required_ext
                    ]);
                }
            }
        } catch (\Exception $e_images) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 2MB'
            ]);
        }

        Pendapatan::where('id',$id)->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull'
        ]);

    }

}
