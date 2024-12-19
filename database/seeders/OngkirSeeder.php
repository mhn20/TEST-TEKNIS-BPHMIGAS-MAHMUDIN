<?php

namespace Database\Seeders;

use App\Models\Ongkir;
use App\Models\User;

use Illuminate\Database\Seeder;
use App\Models\DataWebsite as DataWebsiteModels;
use DB;

class OngkirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_ongkir = file_get_contents(public_path('tb_ongkir.json'));
        $json_ongkir = json_decode($json_ongkir, true);
        
        Ongkir::whereNotNull('id')->delete();
        $no = 1;
        foreach ($json_ongkir[2]['data'] as $rowindex) {
            Ongkir::create([
                'subdistrict_id' => $rowindex['subdistrict_id'], 'province_id' => $rowindex['province_id'], 
                'province' => $rowindex['province'], 'city_id' => $rowindex['city_id'], 'city' => $rowindex['city'], 'type' => $rowindex['type'],
                'subdistrict_name' => $rowindex['subdistrict_name'], 'service' => $rowindex['service'],
                'description' => $rowindex['description'], 'etd' => $rowindex['etd'], 'ongkir' => $rowindex['ongkirnya']
            ]);
            error_log('Save Ongkir '.$no++);
        }
        
    }
}
