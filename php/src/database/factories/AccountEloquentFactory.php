<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(packages\Infrastructure\Eloquent\Account\AccountEloquent::class, function (Faker $faker) {
    return [
        'id' => Str::random(40),
        'balance' => $faker->randomDigit,
    ];
});
