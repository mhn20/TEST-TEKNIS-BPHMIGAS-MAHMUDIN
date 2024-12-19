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


class EditProfileController extends Controller
{
    public function index(Request $req){
        $object_data = [];
        $object_data['page_title'] = "Change Password";
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
        $dataaset = Asset::where('users_id',$datauser->id)->where('iskontrak',1)->first();
        $object_data['dataaset'] = $dataaset;
        return view('panel.pages.editprofile.form',$object_data);
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

        $datauser = User::where('email',session()->get('login_panel')['email'])->first();

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
        $templateProcessor->setValue('title', $dataaset->title);
        $templateProcessor->setValue('notasi', $dataaset->notasi?'Ada':'Tidak');
        $templateProcessor->setValue('lirik', $dataaset->lirik?'Ada':'Tidak');
        $templateProcessor->setValue('isrc', $dataaset->isrc);
        $templateProcessor->setValue('performer', $dataaset->performer);
        
        // Simpan sebagai dokumen baru (Word)
        $inputPath = public_path('upload/kontrak/hasil/kontrak_'.$no_kontrak.'.docx');
        $templateProcessor->saveAs($inputPath);

        // Tentukan path output PDF
        $outputPath = public_path('upload/kontrak/hasil/kontrak_'.$no_kontrak.'.pdf');

        // Jalankan perintah CLI
        $command = "HOME=/tmp libreoffice --headless --convert-to pdf " . escapeshellarg($inputPath) . " --outdir " . public_path('upload/kontrak/hasil');
        exec($command . ' 2>&1', $output, $returnVar);

        return response()->file($outputPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="kontrak_'.$no_kontrak.'.pdf"',
        ]);

    }

    public function update(Request $req){
        
        $object_data = [];

        $password_lama = $req->password_lama;

        $password_baru = $req->password_baru;
        $confirm_password = $req->confirm_password;

        $user = User::where('email',session()->get('login_panel')['email'])->first();
        if (!Hash::check($password_lama, $user->password)) {
            return response()->json([
                'status' => 500, 'messages' => 'Password Lama Tidak Valid.'
            ]);
        }

        if($password_baru != $confirm_password){
            return response()->json([
                'status' => 500, 'messages' => 'Konfirmasi Password Baru Tidak Valid.'
            ]);
        }

        $object_data['password'] = Hash::make($confirm_password);
        
        User::where('email',session()->get('login_panel')['email'])->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull'
        ]);
    }
}
