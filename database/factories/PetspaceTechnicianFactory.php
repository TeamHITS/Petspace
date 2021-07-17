<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PetspaceTechnician;
use Faker\Generator as Faker;

$factory->define(PetspaceTechnician::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'petspace_id' => $faker->word,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
