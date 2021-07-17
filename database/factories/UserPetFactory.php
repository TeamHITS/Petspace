<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserPet;
use Faker\Generator as Faker;

$factory->define(UserPet::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'name' => $faker->word,
        'type' => $faker->word,
        'gender' => $faker->word,
        'breed' => $faker->word,
        'weight' => $faker->word,
        'color' => $faker->word,
        'chip_id_num' => $faker->word,
        'image' => $faker->word,
        'birthdate' => $faker->date('Y-m-d'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
