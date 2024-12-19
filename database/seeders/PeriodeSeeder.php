<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periode;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        Periode::whereNotNull('id')->delete();
        foreach($select_bulan as $rowindex){
            Periode::create([
                'key' => $rowindex['key'], 'value' => $rowindex['val']
            ]);
        }
    }
}
