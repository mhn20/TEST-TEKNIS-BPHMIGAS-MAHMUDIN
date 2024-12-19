<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $dataset = User::where('email','emailgateway17@gmail.com')->count();
        // if($dataset == 0){
        //     User::create([
        //         'name' => 'admin', 'email' => 'emailgateway17@gmail.com', 'password' => Hash::make('p@ssw0rd'), 'avatar' => '/dist/img/avatar5.png', 'is_admin' => true,
        //         'keyverif' => '-', 'status' => 1, 'isverif' => 1, 'document' => '-',  'keyforgotpassword' => '-'
        //     ]);
        // }
        User::whereNotNull('id')->delete();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('p@ssw0rd'), 'is_admin' => true,
            'avatar' => '/assets/panel/dist/img/avatar.png',
            'keyverif' => '-', 'status' => 1, 'isverif' => 1, 'document' => '-',  'keyforgotpassword' => '-', 'level' => 'admin'
        ]);
        User::create([
            'name' => 'Customer Service Layer 1',
            'email' => 'csl1@gmail.com',
            'password' => Hash::make('p@ssw0rd'), 'is_admin' => true,
            'avatar' => '/assets/panel/dist/img/avatar2.png',
            'keyverif' => '-', 'status' => 1, 'isverif' => 1, 'document' => '-',  'keyforgotpassword' => '-', 'level' => 'csl1'
        ]);
        User::create([
            'name' => 'Customer Service Layer 2',
            'email' => 'csl2@gmail.com',
            'password' => Hash::make('p@ssw0rd'), 'is_admin' => true,
            'avatar' => '/assets/panel/dist/img/avatar3.png',
            'keyverif' => '-', 'status' => 1, 'isverif' => 1, 'document' => '-',  'keyforgotpassword' => '-', 'level' => 'csl2'
        ]);
    }
}
