<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;


$factory->define(Product::class, function ($angka) {
    static $order = 1;
    $faker = Faker\Factory::create('id_ID');
    return [
        'brand_id' =>  App\Brand::inRandomOrder()->first()->id,
        'shop_id' => App\Shop::inRandomOrder()->first()->id,
        'name' => $faker->streetName,
        'price' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'description' => $faker->paragraph

    ];
});
