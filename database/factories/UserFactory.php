<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function () {
    $faker = Faker\Factory::create('id_ID');
    $gender = ['male','female'];
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('12345678'),
        'role' => 2,
        'address' => $faker->address,
        'telephone' => $faker->phoneNumber,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => $gender[rand(0,1)]
    ];
});
