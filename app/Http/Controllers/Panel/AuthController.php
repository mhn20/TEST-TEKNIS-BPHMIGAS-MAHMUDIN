<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DataWebsite;
use Mail;
use App\Mail\MailNotify;

use App\Mail\SendSafeEmail;


class AuthController extends Controller
{

    public function register(Request $req){
        
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.register',$object_data);
    }

    public function confirmForgotPassword(Request $req){
        
        $datauser = User::where('keyforgotpassword',$req->get('keyforgotpassword'))->first();
        if(!$datauser){
            return redirect()->route('panel.login');
        }

        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.forgot_password',$object_data);
    }

    public function changePassword(Request $req){
        $keyforgotpassword = $req->keyforgotpassword;
        $dataset = User::where('keyforgotpassword',$keyforgotpassword)->first();
        if(!$dataset){
            return response()->json([
                'status' => 500, 'messages' => 'Change Password Failed.', 'keyforgotpassword' => $keyforgotpassword
            ]);
        }else{
            $password = $req->password;
            $confirm_password = $req->confirm_password;

            
            if($password != $confirm_password){
                return response()->json([
                    'status' => 500, 'messages' => 'Password Not Valid.'
                ]);
            }else{
                $object_data = [];
                $object_data['password'] = Hash::make($confirm_password);
                $object_data['keyforgotpassword'] = '';
                User::where('keyforgotpassword',$keyforgotpassword)->update($object_data);
                return response()->json([
                    'status' => 200, 'messages' => 'Change Password Successfull.'
                ]);
            }
        }
    }

    public function prosesRegister(Request $req){

        $name = $req->name;
        $email = $req->email;
        $password = $req->password;
        $keyverif = md5($email);
        $confirm_password = $req->confirm_password;
        $avatar = '/assets/panel/dist/img/avatar5.png';

        if($password != $confirm_password){
            return response()->json([
                'status' => 500, 'messages' => 'Password Not Valid'
            ]);
        }

        $dataset = User::where('email',$email)->count();
        if($dataset > 0){
            return response()->json([
                'status' => 500, 'messages' => 'Register Failed, Email is Already'
            ]);
        }

        $datawebsite = DataWebsite::first();

        $subject = 'Registrasi - '.$datawebsite->title;

        $data = [
            'subject' => htmlspecialchars($subject),
            'judul' => htmlspecialchars($datawebsite->title),
            'icon' => htmlspecialchars($datawebsite->icon),
            'keyverif' => htmlspecialchars($keyverif),
            'judul_body' => htmlspecialchars($datawebsite->title), 'footer' => htmlspecialchars($datawebsite->footer),
            'icon' => url($datawebsite->icon), 'name' => htmlspecialchars($name), 'email' => htmlspecialchars($email),
            'action' => 'register'
        ];

        try {
            Mail::to($email)->send(new MailNotify($data));

            $object_data = [];
            $object_data['name'] = $name;
            $object_data['email'] = $email;
            $object_data['avatar'] = $avatar;
            $object_data['is_admin'] = false;

            // session()->put([
            //     'login_panel' => $object_data
            // ]);

            User::create([
                'name' => $name, 'email' => $email, 'password' => Hash::make($confirm_password), 'avatar' => $avatar, 'is_admin' => false,
                'keyverif' => $keyverif, 'status' => 1, 'isverif' => 0, 'document' => '-',  'keyforgotpassword' => '-'
            ]);

            return response()->json([
                'status' => 200, 'messages' => 'Register Berhasil, Silahkan Cek Email Masuk / Spam Anda', 'keyverif' => $keyverif
            ]);
            
        } catch (Exception $th) {
            return response()->json([
                'status' => 500, 'messages' => 'Register Failed'
            ]);
        }


    }

    public function resendAktivasi(Request $req){
        
        $datauser = User::where('email',session()->get('login_panel')['email'])->first();
        
        if($datauser->isverif == '1'){
            return response()->json([
                'status' => 500, 'messages' => 'Aktivasi is Available'
            ]);
        }

        $name = $datauser->name;
        $email = $datauser->email;
        $keyverif = md5($email);
        $avatar = '/assets/panel/dist/img/avatar5.png';

        $datawebsite = DataWebsite::first();

        $subject = 'Resend Aktivasi - '.$datawebsite->title;

        $data = [
            'subject' => htmlspecialchars($subject),
            'judul' => htmlspecialchars($datawebsite->title),
            'icon' => htmlspecialchars($datawebsite->icon),
            'keyverif' => htmlspecialchars($keyverif),
            'judul_body' => htmlspecialchars($datawebsite->title), 'footer' => htmlspecialchars($datawebsite->footer),
            'icon' => url($datawebsite->icon), 'name' => htmlspecialchars($name), 'email' => htmlspecialchars($email),
            'action' => 'resend_aktivasi'
        ];

        try {
            Mail::to($email)->send(new MailNotify($data));

            return response()->json([
                'status' => 200, 'messages' => 'Data Telah Terkirim, Silahkan Cek Email Masuk / Spam'
            ]);
            
        } catch (Exception $th) {
            return response()->json([
                'status' => 500, 'messages' => 'Register Failed'
            ]);
        }
        
    }


    public function sendForgotPassword(Request $req){
        date_default_timezone_set('Asia/Jakarta');
        $datauser = User::where('email',$req->email)->first();
        if(!$datauser){
            return response()->json([
                'status' => 500, 'messages' => 'Email Not Register'
            ]);
        }

        $name = $datauser->name;
        $email = $datauser->email;
        $keyforgotpassword = md5($email."-".date('YmdHis'));
        $avatar = '/assets/panel/dist/img/avatar5.png';

        $datawebsite = DataWebsite::first();

        $subject = 'Send Forgot Password - '.$datawebsite->title;

        $data = [
            'subject' => htmlspecialchars($subject),
            'judul' => htmlspecialchars($datawebsite->title),
            'icon' => htmlspecialchars($datawebsite->icon),
            'keyforgotpassword' => htmlspecialchars($keyforgotpassword),
            'judul_body' => htmlspecialchars($datawebsite->title), 'footer' => htmlspecialchars($datawebsite->footer),
            'icon' => url($datawebsite->icon), 'name' => htmlspecialchars($name), 'email' => htmlspecialchars($email),
            'action' => 'send_forgot_password'
        ];

        try {
            Mail::to($email)->send(new MailNotify($data));
            User::where('email',$req->email)->update([
                'keyforgotpassword' => $keyforgotpassword
            ]);
            return response()->json([
                'status' => 200, 'messages' => 'Data Telah Terkirim, Silahkan Cek Email Masuk / Spam'
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => 500, 'messages' => 'Send Forgot Password Failed'
            ]);
        }
        
    }

    public function updateIsverif(Request $req){
        $keyverif = $req->keyverif;
        $dataset = User::where('keyverif',$keyverif)->first();
        if(!$dataset){
            return response()->json([
                'status' => 500, 'messages' => 'Aktivasi Failed'
            ]);
        }else{
            if($dataset->isverif == '1'){
                return response()->json([
                    'status' => 500, 'messages' => 'Aktivasi is Available'
                ]);
            }else{
                User::where('keyverif',$keyverif)->update([
                    'isverif' => 1
                ]);
                return response()->json([
                    'status' => 200, 'messages' => 'Aktivasi Successfull'
                ]);
            }
        }
    }

    public function login(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['datawebsite'] = $datawebsite;
        if($req->get('action') == 'login_only'){
            session()->put('action','login_only');
            return view('panel.login_only',$object_data);
        }
        session()->forget('action');
        if($req->get('keyverif_register')){
            $datauser = User::where('keyverif',$req->get('keyverif_register'))->where('isverif','<>',1)->first();
            if(!$datauser){
                return redirect()->route("panel.login");
            }
            $object_data['datauser'] = $datauser;
            return view('panel.verification_after_register',$object_data);
        }
        return view('panel.login',$object_data);
    }

    public function prosesLogin(Request $req){
        $user = User::where('email', $req->email)->first();
        if ($user && Hash::check($req->password, $user->password)) {

            $user_verif = User::where('email', $req->email)->where('isverif',1)->first();
            if ($user_verif && Hash::check($req->password, $user_verif->password)) {
                $object_data = [];
                $object_data['name'] = $user->name;
                $object_data['email'] = $user->email;
                $object_data['avatar'] = $user->avatar;
                $object_data['is_admin'] = $user->is_admin;
                $object_data['level'] = $user->level;
                session()->put([
                    'login_panel' => $object_data
                ]);
                return response()->json([
                    'status' => 200, 'messages' => 'Login Successfull'
                ]);
            }else{
                return response()->json([
                    'status' => 500, 'messages' => 'Login Failed, Akun Anda Harus Diverifikasi Terlebih Dahulu.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 500, 'messages' => 'Login Failed, Username & Password Salah'
            ]);
        }
    }

    public function logout(Request $req){
        session()->forget('login_panel');
        if(session()->get('action')){
            return redirect('panel/login?action='.session()->get('action'));
        }
        return redirect()->route('panel.login');
    }
}
