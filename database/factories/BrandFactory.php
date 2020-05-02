<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;


$factory->define(Brand::class, function () {
    static $order = 1;
    $faker = Faker\Factory::create('en_US');
    return [
        'product_type_id' => App\ProductType::inRandomOrder()->first()->id,
        'name' => $faker->company
    ];
});
