<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(HomeTypeSeeder::class);
        //$this->call(UserSeeder::class);
      $this->call(HomeSeeder::class);
        
}
}