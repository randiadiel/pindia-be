<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductType;


$factory->define(ProductType::class, function () {

    $faker = Faker\Factory::create('id_ID');
    return [
        'name' => $faker->colorName
    ];
});
