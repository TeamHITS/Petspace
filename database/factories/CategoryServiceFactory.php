<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryService;
use Faker\Generator as Faker;

$factory->define(CategoryService::class, function (Faker $faker) {

    return [
        'category_id' => $faker->word,
        'name' => $faker->word,
        'description' => $faker->text,
        'price' => $faker->randomDigitNotNull,
        'discount' => $faker->randomDigitNotNull,
        'service_duration' => $faker->word,
        'image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
