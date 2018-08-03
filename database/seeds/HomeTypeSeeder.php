<?php

use Illuminate\Database\Seeder;
use App\HomeType;
class HomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = ['nametype'=>'Cho thuê phòng trọ'];
        HomeType::create($data);
    }
}
