<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataWebsite;
use App\Models\Cart;
use App\Models\Ongkir;
use App\Models\Invoice;
use App\Models\InvoiceDetail;

class CartController extends Controller
{
    public function postData(Request $req){

        $email_cart = date('YmdHis').'@gmail.com';
        session()->put([
            'cart' => [
                'email' => $email_cart
            ]
        ]);

        $session_email_cart = session()->get('cart')['email'];
        if(!$session_email_cart){
            $datauser = User::create([
                'name' => '-', 'email' => $session_email_cart, 'password' => Hash::make('p@ssw0rd'), 'avatar' => '-', 'is_admin' => false,
                'keyverif' => 'cart', 'status' => 1, 'isverif' => 1, 'document' => '-',  'keyforgotpassword' => '-'
            ]);
        }else{
            $datauser = User::where('email',$session_email_cart)->first();
        }
        Cart::create([
            'users_id' => $datauser->id,
            'barang_id' => $req->barang_id,
            'jumlah' => $req->jumlaj
        ]);

        return response()->json([
            'status' => 200, 'messages' => 'Keranjang Berhasil Ditambahkan'
        ]);
        
    }

    public function getProvince(Request $req){
        $dataset = Ongkir::select('province')->groupBy('province')->orderBy('province','asc')->get();
        return response()->json([
            'data' => $dataset
        ]);
    }

    public function getCity(Request $req){
        $province = $req->get('province');
        $dataset = Ongkir::select('city')->where('province',$province)->groupBy('city')->orderBy('city','asc')->get();
        return response()->json([
            'data' => $dataset
        ]);
    }

    public function getSubdistrictName(Request $req){
        $city = $req->get('city');
        $dataset = Ongkir::select('subdistrict_name')->where('city',$city)->groupBy('subdistrict_name')->orderBy('subdistrict_name','asc')->get();
        return response()->json([
            'data' => $dataset
        ]);
    }

    public function getJenisPengiriman(Request $req){
        $subdistrict_name = $req->get('subdistrict_name');
        $dataset = Ongkir::where('subdistrict_name',$subdistrict_name)->orderBy('description','asc')->get();
        return response()->json([
            'data' => $dataset
        ]);
    }

    public function data(Request $req){
        $session_email_cart = @session()->get('cart')['email'];
        $datauser = User::where('email',$session_email_cart)->first();
        $datacart = Cart::with('user','barang')->where('users_id',$datauser->id)->orderBy('id','DESC');
        return response()->json([
            'data' => $datacart->get(), 'totalcart' => $datacart->count()
        ]);
    }

    public function updateJumlah(Request $req, $id){
        if($req->jumlah == 0){
            Cart::where('id',$id)->delete();
        }else{
            $datacart = Cart::where('id',$id)->update([
                'jumlah' => $req->jumlah
            ]);
        }
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull'
        ]);
    }

    public function delete(Request $req, $id){
        Cart::where('id',$id)->delete();
        return response()->json([
            'status' => 200, 'messages' => 'Delete Successfull'
        ]);
    }

}
