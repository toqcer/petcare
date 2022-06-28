<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Worker;
use Faker\Generator as Faker;

$factory->define(Worker::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name(),
    ];
});
