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
        $this->call('UserSeeder');
        $this->call('ShopSeeder');
        $this->call('ProductTypeSeeder');
        $this->call('BrandSeeder');
        $this->call('ProductSeeder');
    }
}
