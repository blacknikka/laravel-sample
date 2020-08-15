<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use packages\Infrastructure\Eloquent\Account\AccountEloquent;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use packages\Domain\Domain\Game\State\StateStatics;

$factory->define(packages\Infrastructure\Eloquent\User\UserEloquent::class, function (Faker $faker) {
    $account = factory(packages\Infrastructure\Eloquent\Account\AccountEloquent::class)->create();
    var_dump($account->id);
    return [
        'id' => Str::random(40),
        'token' => Str::random(40),
        'state' => $faker->randomElement($array = StateStatics::getStates()),
        'counter' => $faker->numberBetween(0, 5),
        'account_id' => $account->id,
    ];
});
