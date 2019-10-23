<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Post;
use App\Models\User;
use Faker\Generator;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Generator $faker) {
    $title = $faker->sentence;
    $slug = Str::slug($title, '-');
    return [
        'title' => $title,
        'slug' => $slug,
        'content' => $faker->paragraph,
        'posted_at' => now(),
        'author_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
