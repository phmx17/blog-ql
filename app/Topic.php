<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // return type as of php 7.1

class Topic extends Model
{
  // allow mass assignments in seeder = insert more than one col with ::create()
  protected $fillable = ['name', 'slug'];

  public function posts(): HasMany  // 'posts' is arbitrary; HasMany is a return type introduced in PHP 7.1
  {
    return $this->hasMany(Post::class); // hasMany is from Model base class; Topic model has many Post models
  }
}
// Topic is the owner of Post
// Relationship is one to many; Topic has many posts 
// $foreignKey is in the owned model: Post
// laravel will suffix column name with lowercase 'owner'_ID
// so Post will have a column called 'topic_ID'
// the column entries will be the $localkey, which is Topic's ID - obvious
// is is possible for $localkey to point to a different field besides the ID, but this is rare; it would have to be defined here
// this creates a physical connection in the DB
// SO: by calling method posts() (=Topic) I can get access to all related posts.

// the relation from Post is called 'inverse side'.
// each Post can ONLY have one topic associated with it. - duh!
// go see Post.php
