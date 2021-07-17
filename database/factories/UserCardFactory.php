<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserCard;
use Faker\Generator as Faker;

$factory->define(UserCard::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'ref' => $faker->word,
        'type' => $faker->word,
        'first_digits' => $faker->word,
        'last_digits' => $faker->word,
        'country' => $faker->word,
        'expire_month' => $faker->word,
        'expire_year' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
