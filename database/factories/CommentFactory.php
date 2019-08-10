<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'post_id' => 1,
        'comment_id' => null,
        'text' => $faker->paragraph(2, true),
        'likes' => $faker->randomDigit
    ];
});
