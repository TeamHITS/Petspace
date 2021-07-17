<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubmenuService;
use Faker\Generator as Faker;

$factory->define(SubmenuService::class, function (Faker $faker) {

    return [
        'submenu_id' => $faker->word,
        'name' => $faker->word,
        'description' => $faker->text,
        'price' => $faker->randomDigitNotNull,
        'discount' => $faker->randomDigitNotNull,
        'service_duration' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
