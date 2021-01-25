<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // import for return type; new in php 7.1 - use it!

class Post extends Model
// set up relations to Topic and User
{
  public function topic(): BelongsTo  // topic() is arbitrary; BelongsTo is return type
  {
    return $this->belongsTo(Topic::class);  // belongsTo() is from Model base class
  }
  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id'); // defining foreign key here; would be 'user_id'; MUST ALLWAYS DO THIS ON 'BOTH SIDES', so also in User
  }

}

// the relation from Post is called 'inverse side'.
// each Post can ONLY have one topic and one User associated with it.
// This relation is called many to one.

// $ownerKey identifier would be defined here if anything other than owner ID

// This is info is from Topic.php:
// Topic is the owner of Post  
// $foreignKey is in the owned model: Post
// laravel will suffix column name with lowercase 'owner'_ID
// so Post will have a column called 'topic_ID'
// the column entries will be the $localkey, which is Topic's ID - obvious
// is is possible for $localkey to point to a different field besides the ID, but this is rare; it would have to be defined here
// this creates a physical connection in the DB
// SO: by calling method posts() (=Topic) I can get access to all related posts.

// next step is to create tables to store these relationships with a tasty migration: $  php artisan make:migration AddForeignKeysToPostsTable

