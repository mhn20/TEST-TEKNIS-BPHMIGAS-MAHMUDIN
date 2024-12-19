<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\DocumentContract;
use App\Models\User;
use App\Models\Asset;
use Illuminate\Support\Facades\Hash;

use Mail;
use App\Mail\MailNotify;

class UsersController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Data Composer";
        $object_data['datawebsite'] = $datawebsite;
        if($req->get('action') == 'tambah'){
            $datauser = User::select('id')->orderBy('id','DESC')->first();
            $object_data['datauser'] = $datauser;
            if($datauser){
                $users_id = (int)$datauser->id+1;
                if(strlen($users_id) == 1){
                    $auto_no_kontrak = '0'.$users_id;
                }else{
                    $auto_no_kontrak = $users_id;
                }
            }else{
                $auto_no_kontrak = 1;
            }
            $object_data['auto_no_kontrak'] = $auto_no_kontrak;
            return view('panel.pages.users.tambah',$object_data);
        }

        if($req->get('action') == 'preview' or $req->get('action') == 'edit'){
            $users_id = $req->get('users_id');
            $datauser = User::where('id',$users_id)->first();
            if(!$datauser){
                toastr()->error('Data Composer Tidak Ditemukan');
                return redirect()->route('panel.users');
            }
            $users_id = $req->get('users_id');
            if($users_id){
                if(strlen($users_id) == 1){
                    $auto_no_kontrak = '0'.$users_id;
                }else{
                    $auto_no_kontrak = $users_id;
                }
                $auto_no_kontrak = "HYP-".$auto_no_kontrak."/SSS-HMP/".date('m')."/".date('Y');
            }else{
                $auto_no_kontrak = $datauser->no_kontrak;
            }
            $object_data['auto_no_kontrak'] = $auto_no_kontrak;
            $object_data['datauser'] = $datauser;
            if($req->get('action') == 'preview'){
                return view('panel.pages.users.preview',$object_data);
            }
            return view('panel.pages.users.edit',$object_data);
        }

        return view('panel.pages.users.index',$object_data);
    }

    public function data(Request $req){

        $limit = $req->get('limit',10);

        $sess_email = session()->get('login_panel')['email'];
        $sess_is_admin = session()->get('login_panel')['is_admin'];
        $search = $req->get('search');

        $dataset = User::where('is_admin','<>',1);

        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orWhere('name','LIKE','%'.$search.'%')
                            ->orWhere('email','LIKE','%'.$search.'%')
                            ->orWhere('alias','LIKE','%'.$search.'%')
                            ->orWhere('nik','LIKE','%'.$search.'%')
                            ->orWhere('npwp','LIKE','%'.$search.'%')
                            ->orWhere('telp','LIKE','%'.$search.'%')
                            ->orWhere('norek','LIKE','%'.$search.'%')
                            ->orWhere('nama_rek','LIKE','%'.$search.'%');
            });
        }

        $orderby = $req->get('orderby');

        if($orderby == 'terbaru'){
            $dataset = $dataset->orderBy('id','DESC');
        }else{
            $dataset = $dataset->orderBy('id','ASC');
        }
        

        $dataset = $dataset->paginate($limit);

        foreach($dataset as $rowindex){
            $dataaset = Asset::where('users_id',$rowindex->id)->count();
            $rowindex['total_aset'] = $dataaset;
            if(strlen($rowindex->id) == 1){
                $work_id = "0".$rowindex->id;
            }else{
                $work_id = $rowindex->id;
            }
            $rowindex['work_id'] = 'HYPE'.$work_id;
        }

        return response()->json($dataset);

    }

    public function updateVerifikasi(Request $req){
        $id = $req->id;
        $isverif = $req->isverif;
        $isverifadmin = $req->isverifadmin;
        $keterangan = $req->keterangan;
        $dataset = User::where('id',$id)->first();
        if($dataset){

            $datawebsite = DataWebsite::first();

            // if($isverifadmin !==0){
                if($isverifadmin == 1){
                    $subject = 'Selamat! Akun Anda Berhasil Terverifikasi Oleh Admin - '.$datawebsite->title;
                    $judul = "Selamat! Akun Anda Berhasil Terverifikasi Oleh Admin";
                }else{
                    $subject = 'Mohon Maaf, Akun Anda Tidak Terverifikasi Oleh Admin - '.$datawebsite->title;
                    $judul = "Mohon Maaf, Akun Anda Tidak Terverifikasi Oleh Admin";
                }
    
                $data = [
                    'action' => 'verifikasi', 'icon' => url($datawebsite->icon), 'name' => htmlspecialchars($dataset->name), 'footer' => htmlspecialchars($datawebsite->footer),
                    'from_mail' => $dataset->email,
                    'subject' => $subject,
                    'judul' => $judul,
                    'keterangan' => htmlspecialchars($keterangan)
                ];
    
                try {
                    Mail::to($dataset->email)->send(new MailNotify($data));
                } catch (Exception $th) {
                    return response()->json([
                        'status' => 500, 'messages' => 'Email Gagal Terkirim'
                    ]);
                }

            // }

            $dataset->update([
                'isverif' => $isverif, 'isverifadmin' => $isverifadmin, 'keterangan' => $keterangan
            ]);

            return response()->json([
                'status' => 200, 'messages' => 'Save Successfull'
            ]);
        }else{
            return response()->json([
                'status' => 500, 'messages' => 'Data Tidak Ditemukan'
            ]);
        }
    }

    public function postData(Request $req){

        $cekemail = User::where('email',$req->email)->count();
        if($cekemail > 0){
            return response()->json([
                'status' => 500, 'messages' => 'Email Is Available..'
            ]);
        }

        if($req->pragita_composer_id){
            $cek_pragita_composer_id = User::where('pragita_composer_id',$req->pragita_composer_id)->count();
            if($cek_pragita_composer_id > 0){
                return response()->json([
                    'status' => 500, 'messages' => 'PGT Composer ID Is Available..'
                ]);
            }
        }

        $datauser = User::select('id')->orderBy('id','DESC')->first();
        $object_data['datauser'] = $datauser;
        if($datauser){
            $users_id = (int)$datauser->id+1;
            if(strlen($users_id) == 1){
                $auto_no_kontrak = '0'.$users_id;
            }else{
                $auto_no_kontrak = $users_id;
            }
        }else{
            $auto_no_kontrak = 1;
        }

        $password = $req->password;
        $confirm_password = $req->confirm_password;
        $object_data = [
            'name' => $req->name
        ];
        $object_data['document'] = '-';
        $object_data['keyverif'] = '-';
        $object_data['status'] = 1;
        $object_data['keyforgotpassword'] = '-';
        $object_data['email'] = $req->email;
        $object_data['no_kontrak'] = $auto_no_kontrak;
        $object_data['nama_lengkap']= $req->nama_lengkap;
        $object_data['alias']= $req->alias;
        $object_data['nik']= $req->nik;
        $object_data['alamat']= $req->alamat;
        $object_data['telp']= $req->telp;
        $object_data['isnpwp']= $req->isnpwp;
        $object_data['npwp']= $req->npwp;
        $object_data['norek']= $req->norek; 
        $object_data['nama_rek']= $req->nama_rek;
        $object_data['pragita_composer_id']= $req->pragita_composer_id;
        $object_data['cabang']= $req->cabang;
        $object_data['namabank']= $req->namabank;
        $object_data['tempat']= $req->tempat;
        $object_data['isverif'] = 1;
        $object_data['isverifadmin'] = 1;
        $object_data['is_admin'] = 0;

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
            }else{
                $object_data['avatar'] = '/assets/panel/dist/img/avatar5.png';
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

        User::create($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_avatar' => @$save_avatar
        ]);

    }

    public function updateData(Request $req, $id){
        if($req->pragita_composer_id){
            $cek_pragita_composer_id = User::where('id','<>',$id)->where('pragita_composer_id',$req->pragita_composer_id)->count();
            if($cek_pragita_composer_id > 0){
                return response()->json([
                    'status' => 500, 'messages' => 'PGT Composer ID Is Available..'
                ]);
            }
        }

        $datauser = User::select('id')->orderBy('id','DESC')->first();
        $object_data['datauser'] = $datauser;

        $no_kontrak = $req->no_kontrak;

        if($no_kontrak){
            if($datauser){
                $users_id = (int)$datauser->id+1;
                if(strlen($users_id) == 1){
                    $auto_no_kontrak = '0'.$users_id;
                }else{
                    $auto_no_kontrak = $users_id;
                }
            }else{
                $auto_no_kontrak = 1;
            }
            $auto_no_kontrak = "HYP-".$auto_no_kontrak."/SSS-HMP/".date('m')."/".date('Y');
        }else{
            $auto_no_kontrak = $no_kontrak;
        }

        $password = $req->password;
        $confirm_password = $req->confirm_password;
        $object_data = [
            'name' => $req->name
        ];
        $object_data['no_kontrak'] = $auto_no_kontrak;
        $object_data['nama_lengkap']= $req->nama_lengkap;
        $object_data['alias']= $req->alias;
        $object_data['nik']= $req->nik;
        $object_data['alamat']= $req->alamat;
        $object_data['telp']= $req->telp;
        $object_data['isnpwp']= $req->isnpwp;
        $object_data['npwp']= $req->npwp;
        $object_data['norek']= $req->norek; 
        $object_data['nama_rek']= $req->nama_rek;
        $object_data['pragita_composer_id']= $req->pragita_composer_id;
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

        User::where('id',$id)->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_avatar' => @$save_avatar
        ]);

    }

    public function updatePragitaComposerID(Request $req, $id){
        $object_data = [];
        $is_admin = session()->get('login_panel')['is_admin'];
        if($is_admin!=1){
            $object_data['status'] = 500;
            $object_data['messages'] = "PGT Composer ID Hanya Bisa Diakses Oleh Admin";
        }else{
            if(!$req->pragita_composer_id){
                $object_data['status'] = 500;
                $object_data['messages'] = "PGT Composer ID Tidak Boleh Kosong";
            }else{
                $cekdata = User::where('id','<>',$id)->where('pragita_composer_id',$req->pragita_composer_id)->count();
                if($cekdata > 0){
                    $object_data['status'] = 500;
                    $object_data['messages'] = "PGT Composer ID Sudah Tersedia.";
                }else{
                    User::where('id',$id)->update(['pragita_composer_id'=>$req->pragita_composer_id]);
                    $object_data['status'] = 200;
                    $object_data['messages'] = "Save Successfull";
                }
            }
        }
        return response()->json($object_data);
    }

    public function deleteData(Request $req, $id){
        User::where('id',$id)->delete();
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

}
