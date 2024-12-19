<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataWebsite as DataWebsiteModels;
use DB;

class DataWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataset = DataWebsiteModels::count();
        if($dataset == 0){
            DataWebsiteModels::create([
                'title' => 'Hype Music', 'meta' => '-', 'footer' => 'Hype Music 2024', 'alamat' => '-', 'icon' => '-', 'about'=>'-', 'term_condition' => '-'
            ]);
        }
    }
}
