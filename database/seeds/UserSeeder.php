<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = ['username'=>'admin','password'=>Hash::make('123456'),'phone'=>'0961467216','status'=>1];
        User::create($data);

    }
}
