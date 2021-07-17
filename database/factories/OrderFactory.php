<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'petspace_id' => $faker->word,
        'status' => $faker->word,
        'address' => $faker->word,
        'latitude' => $faker->word,
        'longitude' => $faker->word,
        'date_time' => $faker->date('Y-m-d H:i:s'),
        'rating' => $faker->randomDigitNotNull,
        'delivery_fee' => $faker->randomDigitNotNull,
        'total' => $faker->randomDigitNotNull,
        'note' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
