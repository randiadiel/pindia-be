<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop;


$factory->define(Shop::class, function () {
    static $order = 1; 
    $faker = Faker\Factory::create('id_ID');
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'name' => $faker->company,
        'address' => $faker->address
    ];
});
