<?php

use App\User;   // import class User from namespace App
use App\Topic;
use App\Post;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      factory(User::class, 20)->create();   // create also saves immediately, otherwise nothing will be stored to DB
      // set some name and slug fields
      // ::create() is a standard method for every model
      Topic::create(['name' => 'Featured Sites','slug' =>'featured']);
      Topic::create(['name' => 'Useful Links','slug' =>'links']);
      Topic::create(['name' => 'Guides & Tutorials','slug' =>'tutorials']);
      // factory some posts
      factory(Post::class, 20)->create();

    }
}
// find fields for a Model in migrations not the model file
// id is handled by DB, timestamps is handled by laravel
// always import models

// running this migration with --seed would fail because of 'mass assignments' = more than one col-assignments per ::create()
// therefore allow in Topic model with: protected $fillable = ['name', 'slug'];

// error: "SQLite doesn't support multiple calls to dropColumn / renameColumn in a single modification."
// this is only SQLITE and is due to :refresh where cols are dropped and added in same transaction
// ALSO SQLite doesn't support dropping foreign keys; so comment them out of migration for now

// on to creating factory for posts: php artisan make:factory PostFactory
// have fun with tinker to see how factory creates shit incl. sexy names