<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    # One to Many (inverse)
    # Post belongs to a user
    # To get the owner of a post
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    # One to many
    # Post has many comments
    # To get all the comments of the post
    # This method will be used in Show Post Page to display all the comments of a post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
