<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataWebsite;
use App\Models\Asset;
use App\Models\Slider;
use App\Models\User;
use App\Models\Pendapatan;
use App\Models\Barang;
use App\Models\InvoiceDetail;

class DashboardController extends Controller
{
    public function index(Request $req){
        $object_data = [];
        $is_admin = session()->get('login_panel')['is_admin'];
        $dataslider = Slider::orderBy('id','DESC')->get();
        $dataasset = new Barang; 
        $tahunbulan = date('Ym');
        $datapendapatan = new InvoiceDetail;
        $object_data['total_pendapatan'] = number_format($datapendapatan->sum('subtotal'),0,',','.');
        $datawebsite = DataWebsite::first();
        $object_data['total_asset'] = $dataasset->count();
        $object_data['periode'] = 'Periode '.$this->labelPeriode($tahunbulan);
        $object_data['dataslider'] = $dataslider;
        $object_data['page_title'] = 'Dashboard';
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.pages.dashboard.index',$object_data);
    }

    function labelPeriode($tahunbulan){
        $tahun = substr($tahunbulan,0,4);
        $bulan = substr($tahunbulan,4,2);
        $label_bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        return $label_bulan[(int)$bulan-1].' '.$tahun;
    }

}
