<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Petspace;
use Faker\Generator as Faker;

$factory->define(Petspace::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'grooming' => $faker->word,
        'is_delivery_fee' => $faker->word,
        'is_pick_drop_available' => $faker->word,
        'delivery_fee' => $faker->randomDigitNotNull,
        'rating' => $faker->randomDigitNotNull,
        'latitude' => $faker->word,
        'longitude' => $faker->word,
        'image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
