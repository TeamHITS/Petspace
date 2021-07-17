<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'order_id' => $faker->word,
        'transaction_id' => $faker->word,
        'payment_status' => $faker->word,
        'amount' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'delated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
