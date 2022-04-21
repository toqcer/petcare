<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\HealthPackage;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(HealthPackage::class, function (Faker $faker) {
    $title = $faker->word();

    return [
        'title' => $faker->word($title),
        'slug' => Str::slug($title),
        'caption' => $faker->sentence(),
        'about' => $faker->paragraph(),
        'perfume' => $faker->sentence(),
        'vitamin' => $faker->word(),
        'snack' => $faker->word(),
        'duration' => $faker->randomElement([30, 60, 90]),
        'package_name' => $faker->word(),
        'price' => $faker->numberBetween(10000, 100000)
    ];
});
