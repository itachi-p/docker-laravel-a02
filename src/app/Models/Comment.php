<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    # One to Many (inverse)
    # Comment belongs to a user
    # To get the owner/user of the comment
    # This method will be used in Show Post Page to display the owner name of the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
