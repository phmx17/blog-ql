<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
      'title' => $faker->sentence(3), // 3 words
      'content' => $faker->paragraphs(10, true),  // true, otherwise will return an array or paras!
      'lead' => $faker->text(200),  // 200 letters
      'author_id' => random_int(1, 20), // we have seeded 20 users
      'topic_id' => random_int(1, 3)  // we manually ::create() 3 topics
    ];
});

// generates a non-specific factory for model 'Model'; so change to Post
// find fields in migration not model
// php artisan tinker ; 'exit' to exit
// >>> factory(App\User::class, 5)->make()f
// creates 5 random users; this is kewl stuff!
// after saving this factory, re run tinker to use post factory
// >>> factory(App\Post::class, 10)->make()
