<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubmenuList;
use Faker\Generator as Faker;

$factory->define(SubmenuList::class, function (Faker $faker) {

    return [
        'cat_service_id' => $faker->word,
        'name' => $faker->word,
        'decription' => $faker->text,
        'condition_option' => $faker->word,
        'select_count' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
