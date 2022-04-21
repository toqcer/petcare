<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gallery;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {
    return [
        'health_packages_id' => $faker->numberBetween(1, 3),
        'image' => $faker->randomElement([
            'https://cdn.pixabay.com/photo/2019/02/20/10/51/spiderman-4008954__340.jpg',
            'https://cdn.pixabay.com/photo/2020/04/21/11/52/batman-5072811__340.jpg',
            'https://cdn.pixabay.com/photo/2022/03/23/00/42/spider-man-7086184__340.jpg'
        ])
    ];
});
