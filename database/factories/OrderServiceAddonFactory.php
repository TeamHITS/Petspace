<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderServiceAddon;
use Faker\Generator as Faker;

$factory->define(OrderServiceAddon::class, function (Faker $faker) {

    return [
        'order_service_id' => $faker->word,
        'submenu_service_id' => $faker->word,
        'price' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
