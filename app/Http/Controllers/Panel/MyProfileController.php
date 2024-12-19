<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\User;
use App\Models\Asset;

use Illuminate\Support\Facades\Hash;

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

use Mail;
use App\Mail\MailNotify;


class MyProfileController extends Controller
{
    public function index(Request $req){
        $object_data = [];
        $object_data['page_title'] = "My Profile";
        $datawebsite = DataWebsite::first();
        $object_data['datawebsite'] = $datawebsite;
        $datauser = User::where('email',session()->get('login_panel')['email'])->first();
        if($datauser){
            if(strlen((String)$datauser->id) == 1){
                $object_data['auto_no_kontrak'] = "0".$datauser->id;
            }else{
                $object_data['auto_no_kontrak'] = $datauser->id;
            }
        }else{
            $object_data['auto_no_kontrak'] = 1;
        }
        $object_data['datauser'] = $datauser;
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
        $dataaset = Asset::where('users_id',$datauser->id)->first();
        $object_data['dataaset'] = $dataaset;
        
        if($datauser->tempat or $datauser->alamat or $datauser->alias or $datauser->telp or $datauser->telp or $datauser->nik or $datauser->dokumen_ktp or $datauser->npwp or $datauser->dokumen_npwp or $datauser->cabang or $datauser->namabank or $datauser->norek or $datauser->nama_rek or @$dataaset->title or (@$dataaset->notasi and @$dataaset->lirik) or @$dataaset->performer or (@$dataaset->isrc and @$dataaset->link_youtube_official and @$dataaset->link_youtube_others)){
            if($req->get('action')=='edit'){
                return view('panel.pages.myprofile.form',$object_data);
            }else{
                return view('panel.pages.myprofile.preview',$object_data);
            }
        }
        return view('panel.pages.myprofile.form',$object_data);
    }

    function hari($timestamp = '', $date_format = 'l', $suffix = '')
    {
        if (trim($timestamp) == '') {
            $timestamp = time();
        } elseif (!ctype_digit($timestamp)) {
            $timestamp = strtotime($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace("/S/", "", $date_format);
        $pattern = array(
            '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
            '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
            '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
            '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
            '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
            '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
            '/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
            '/November/', '/December/',
        );
        $replace = array(
            'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
            'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember',
        );
        $date = date($date_format, $timestamp);
        $date = preg_replace($pattern, $replace, $date);
        $date = "{$date}{$suffix}";
        return strtoupper($date);
    }


    function Tanggal($timestamp = '', $date_format = 'd F Y', $suffix = '')
    {
        if (trim($timestamp) == '') {
            $timestamp = time();
        } elseif (!ctype_digit($timestamp)) {
            $timestamp = strtotime($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace("/S/", "", $date_format);
        $pattern = array(
            '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
            '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
            '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
            '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
            '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
            '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
            '/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
            '/November/', '/December/',
        );
        $replace = array(
            'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
            'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember',
        );
        $date = date($date_format, $timestamp);
        $date = preg_replace($pattern, $replace, $date);
        $date = "{$date}{$suffix}";
        return strtoupper($date);
    }


    public function download(Request $req){

        $is_admin = session()->get('login_panel')['is_admin'];

        if($is_admin){
            $datauser = User::where('id',$req->get('users_id'))->first();
            if(!$datauser){
                toastr()->error('Data Composer Tidak Ditemukan');
                return redirect()->route('panel.asset');
            }
        }else{
            $datauser = User::where('email',session()->get('login_panel')['email'])->first();
            if(!$datauser){
                toastr()->error('Data Composer Tidak Ditemukan');
                return redirect()->route('panel.myprofile');
            }
        }
        

        if($datauser){
            if(strlen((String)$datauser->id) == 1){
                $no = "0".$datauser->id;
            }else{
                $no = $datauser->id;
            }
        }else{
            $no = 1;
        }

        $no_kontrak = $no.'|SSS-HMP|'.date('m').'|'.date('Y');

        // Path ke template Word
        $templatePath = public_path('upload/kontrak/template/Form HYPE Publisher + Surat Kuasa(NEW FINAL).docx');
        
        // Buat instance TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);
        
        // Set variabel dalam template
        $templateProcessor->setValue('no_kontrak', str_replace('|','/',$no_kontrak));
        $templateProcessor->setValue('hari', $this->hari(date('Y-m-d')));
        $templateProcessor->setValue('tanggal', $this->Tanggal(date('Y-m-d')));
        $templateProcessor->setValue('tempat', strtoupper($datauser->tempat));
        $templateProcessor->setValue('tahun', date('Y'));
        $templateProcessor->setValue('name', $datauser->name);
        $templateProcessor->setValue('alias', $datauser->alias);
        $templateProcessor->setValue('nik', $datauser->nik);
        $templateProcessor->setValue('email', $datauser->email);
        $templateProcessor->setValue('alamat', $datauser->alamat);
        $templateProcessor->setValue('namabank', $datauser->namabank);
        $templateProcessor->setValue('cabang', $datauser->cabang);
        $templateProcessor->setValue('norek', $datauser->norek);
        $templateProcessor->setValue('nama_rek', $datauser->nama_rek);
        $templateProcessor->setValue('npwp', $datauser->npwp);
        $templateProcessor->setValue('telp', $datauser->telp);

        $dataaset = Asset::where('users_id',$datauser->id)->where('iskontrak',1)->first();
        if($dataaset){
            $templateProcessor->setValue('title', $dataaset->title);
            $templateProcessor->setValue('notasi', $dataaset->notasi?'Ada':'Tidak');
            $templateProcessor->setValue('lirik', $dataaset->lirik?'Ada':'Tidak');
            $templateProcessor->setValue('isrc', $dataaset->isrc);
            $templateProcessor->setValue('performer', $dataaset->performer);
        }
        
        // Simpan sebagai dokumen baru (Word)
        $inputPath = public_path('upload/kontrak/hasil/kontrak_'.$no_kontrak.'.docx');
        $templateProcessor->saveAs($inputPath);

        // Tentukan path output PDF
        $outputPath = public_path('upload/kontrak/hasil/kontrak_'.$no_kontrak.'.pdf');

        // Jalankan perintah CLI
        $command = "HOME=/tmp libreoffice --headless --convert-to pdf " . escapeshellarg($inputPath) . " --outdir " . public_path('upload/kontrak/hasil');
        exec($command . ' 2>&1', $output, $returnVar);

        return response()->file($inputPath, [
            // 'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="kontrak_'.$no_kontrak.'.docx"',
        ]);


        return response()->file($outputPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="kontrak_'.$no_kontrak.'.pdf"',
        ]);

    }

    public function update(Request $req){
        
        $datauser = User::where('email',session()->get('login_panel')['email'])->first();
        if($datauser->isverifadmin == 1){
            return response()->json([
                'status' => 500, 'messages' => 'Tidak Dapat Disimpan, Verifikasi Sudah Dilakukan Oleh Admin.'
            ]);
        }
        $dataaset = Asset::where('users_id',$datauser->id)->where('iskontrak',1);

        $object_asset = [];
        
        if($req->title){
            $object_asset['title'] = $req->title;
        }
        if($req->notasi){
            $object_asset['notasi'] = $req->notasi;
        }else{
            $object_asset['notasi'] = 0;
        }
        if($req->lirik){
            $object_asset['lirik'] = $req->lirik;
        }else{
            $object_asset['lirik'] = 0;
        }
        if($req->performer){
            $object_asset['performer'] = $req->performer;
        }
        if($req->isrc){
            $object_asset['isrc'] = $req->isrc;
        }
        if($req->link_youtube_official){
            $object_asset['link_youtube_official'] = $req->link_youtube_official;
        }
        if($req->link_youtube_others){
            $object_asset['link_youtube_others'] = $req->link_youtube_others;
        }
        if($dataaset->count() > 0){
            Asset::where('users_id',$datauser->id)->where('iskontrak',1)->update($object_asset);
        }else{
            if($object_asset){
                $object_asset['cover_art'] = '/upload/assets/sample_1.jpg';
                $object_asset['users_id'] = $datauser->id;
                $object_asset['iskontrak'] = true;
                $action_save = Asset::create($object_asset); 
                $total_aset = Asset::where('users_id',$datauser->id)->count();
                if(strlen($datauser->id) == 1){
                    $users_id = "0".$datauser->id;
                }else{
                    $users_id = $datauser->id;
                }
                if(strlen($total_aset) == 1){
                    $asset_id = "0".$total_aset;
                }else{
                    $asset_id = $total_aset;
                }
                Asset::where('id',$action_save->id)->update(['work_id'=>'HYPE'.$users_id.'-'.'ASSET'.$asset_id]);
            }
        }

        $password = $req->password;
        $confirm_password = $req->confirm_password;
        $object_data = [
            'name' => $req->name
        ];

        if($req->no_kontrak){
            $object_data['no_kontrak'] = $req->no_kontrak;
        }

        $object_data['nama_lengkap']= $req->nama_lengkap;
        $object_data['alias']= $req->alias;
        $object_data['nik']= $req->nik;
        $object_data['alamat']= $req->alamat;
        $object_data['telp']= $req->telp;
        $object_data['isnpwp']= $req->isnpwp;
        $object_data['npwp']= $req->npwp;
        $object_data['norek']= $req->norek; 
        $object_data['nama_rek']= $req->nama_rek;
        // $object_data['composer_id']= $req->composer_id;
        $object_data['cabang']= $req->cabang;
        $object_data['namabank']= $req->namabank;
        $object_data['tempat']= $req->tempat;

        if($password or $confirm_password){
            if($confirm_password != $password){
                return response()->json([
                    'status' => 500, 'messages' => 'Password Not Valid'
                ]);
            }else{
                $object_data['password'] =  Hash::make($confirm_password);
            }
        }

        $save_avatar = null;
        try {
            $required_ext_avatar = 'jpg,jpeg,png';
            if($req->hasFile('avatar')) {
                if (str_contains($required_ext_avatar, @$req->avatar->extension())) { 
                    $name_avatar = strtolower('avatar_'.time().'.'.@$req->avatar->extension());  
                    $validate_avatar = $req->validate([
                        'avatar' => 'max:500',
                    ]);
                    $req->avatar->move(public_path('upload/users'), $name_avatar);
                    $save_avatar = '/upload/users/'.$name_avatar;
                    $object_data['avatar'] = $save_avatar;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'Avatar Harus format :'.$required_ext_avatar
                    ]);
                }
            }
            
        } catch (\Exception $e_avatar) {
            return response()->json([
                'status' => 500, 'messages' => 'Avatar Maksimal 500kb'
            ]);
        }

        $save_dokumen_ktp = null;
        try {
            $required_ext_dokumen_ktp = 'jpg,jpeg,png,pdf';
            if($req->hasFile('dokumen_ktp')) {
                if (str_contains($required_ext_dokumen_ktp, @$req->dokumen_ktp->extension())) { 
                    $name_dokumen_ktp = strtolower('dokumen_ktp_'.time().'.'.@$req->dokumen_ktp->extension());  
                    $validate_dokumen_ktp = $req->validate([
                        'dokumen_ktp' => 'max:2000',
                    ]);
                    $req->dokumen_ktp->move(public_path('upload/users'), $name_dokumen_ktp);
                    $save_dokumen_ktp = '/upload/users/'.$name_dokumen_ktp;
                    $object_data['dokumen_ktp'] = $save_dokumen_ktp;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'Dokumen KTP Harus format :'.$required_ext_dokumen_ktp
                    ]);
                }
            }
            
        } catch (\Exception $e_dokumen_ktp) {
            return response()->json([
                'status' => 500, 'messages' => 'Dokumen KTP Maksimal 2MB'
            ]);
        }


        $save_dokumen_npwp = null;
        try {
            $required_ext_dokumen_npwp = 'jpg,jpeg,png,pdf';
            if($req->hasFile('dokumen_npwp')) {
                if (str_contains($required_ext_dokumen_npwp, @$req->dokumen_npwp->extension())) { 
                    $name_dokumen_npwp = strtolower('dokumen_npwp_'.time().'.'.@$req->dokumen_npwp->extension());  
                    $validate_dokumen_npwp = $req->validate([
                        'dokumen_npwp' => 'max:2000',
                    ]);
                    $req->dokumen_npwp->move(public_path('upload/users'), $name_dokumen_npwp);
                    $save_dokumen_npwp = '/upload/users/'.$name_dokumen_npwp;
                    $object_data['dokumen_npwp'] = $save_dokumen_npwp;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'Dokumen NPWP Harus format :'.$required_ext_dokumen_npwp
                    ]);
                }
            }
        } catch (\Exception $e_dokumen_npwp) {
            return response()->json([
                'status' => 500, 'messages' => 'Dokumen NPWP Maksimal 2MB'
            ]);
        }

        try {
            $required_ext_document = 'pdf,doc,docx';
            if($req->hasFile('document')) {
                if (str_contains($required_ext_document, @$req->document->extension())) { 
                    $name_document = strtolower('document_'.time().'.'.@$req->document->extension());  
                    $validate_document = $req->validate([
                        'document' => 'max:2000',
                    ]);
                    $req->document->move(public_path('upload/users/document'), $name_document);
                    $save_document = '/upload/users/document/'.$name_document;
                    $object_data['document'] = $save_document;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'document Harus format :'.$required_ext_document
                    ]);
                }
            }
        } catch (\Exception $e_avatar) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 2MB'
            ]);
        }

        User::where('email',session()->get('login_panel')['email'])->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_avatar' => @$save_avatar
        ]);
    }

    function labelStatusVerif(Request $req){
        $dataset_verif = User::where('email',session()->get('login_panel')['email'])->where('isverif',1)->first();
        if($dataset_verif){
            if($dataset_verif->isverifadmin == 1){
                return response()->json([
                    'status' => 200,
                    'messages' => 'Akun Anda Sudah Terverifikasi', 'messages_admin' => $dataset_verif->keterangan
                ]);
            }else if($dataset_verif->isverifadmin == -1){
                return response()->json([
                    'status' => -1,
                    'messages' => 'Akun Anda Tidak Terverifikasi ', 'messages_admin' => $dataset_verif->keterangan
                ]);
            }else{
                return response()->json([
                    'status' => 201,
                    'messages' => 'Akun Anda Sudah Terverifikasi Email, Sedang Menunggu Verifikasi Oleh Admin', 'messages_admin' => $dataset_verif->keterangan
                ]);
            }
        }else{
            return response()->json([
                'status' => 500,
                'messages' => 'Selamat! Anda Telah Terdaftar, Untuk Mengaktivasi Akun Anda Klik link aktivasi', 'messages_admin' => null
            ]);
        }
    }


    public function prosesBantuan(Request $req){

        $judul = $req->judul;
        $pesan = $req->pesan;

        $dataset = User::where('email',session()->get('login_panel')['email'])->first();
        if(!$dataset){
            return response()->json([
                'status' => 500, 'messages' => 'Composer Tidak Tersedia'
            ]);
        }

        $datawebsite = DataWebsite::first();

        $subject = 'Pesan Bantuan - '.$datawebsite->title;

        $data = [
            'action' => 'bantuan',
            'from_mail' => $dataset->email,
            'subject' => $subject,
            'judul' => $judul,
            'pesan' => htmlspecialchars($pesan)
        ];

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new MailNotify($data));
            return response()->json([
                'status' => 200, 'messages' => 'Pesan Bantuan Berhasil Terkirim'
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => 500, 'messages' => 'Pesan Bantuan Gagal Terkirim'
            ]);
        }


    }

}
