<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    // preddefinovana premenna pre faker
    $title = $faker->words(4, true);

    return [
        'user_id' => 1,
        'title' => ucfirst($title),
        'slug' => str_slug($title),
        'text' => $faker->paragraph(5, true),
    ];
});
