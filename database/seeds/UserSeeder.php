<?php

use App\User;
use Illuminate\Database\Seeder;
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
        factory(App\User::class, 100)->create();
        User::create([
            'email' => 'user@pindia.com',
            'name' => 'pindia_user',
            'password' => Hash::make('12345678'),
            'role' => 1,
            'address' => 'Jalan panjang',
            'telephone' => '08123456789',
            'birthday' => '1970-01-01',
            'gender' => 'female'
        ]);
    }
}
