<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PromoCode;
use Faker\Generator as Faker;

$factory->define(PromoCode::class, function (Faker $faker) {

    return [
        'code' => $faker->word,
        'discount_percentage' => $faker->word,
        'valid_from' => $faker->date('Y-m-d H:i:s'),
        'valid_to' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
