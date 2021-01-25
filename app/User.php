<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // return type as of php 7.1

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // setting up my relationship of One to Many with Posts;
    public function posts(): HasMany  // return type as of php 7.1 - use it!
    {
      return $this->hasMany(Post::class, 'author_id'); // foreign key naming specified here, because Post wants to have this rather than default 'user_id'; MUST ALLWAYS DO THIS ON 'BOTH SIDES'
    }
}
// 'this has many Posts'; Read my extended docu in Topic and Post
