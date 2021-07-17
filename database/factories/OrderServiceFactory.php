<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderService;
use Faker\Generator as Faker;

$factory->define(OrderService::class, function (Faker $faker) {

    return [
        'pet_id' => $faker->word,
        'order_id' => $faker->word,
        'service_id' => $faker->word,
        'price' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
