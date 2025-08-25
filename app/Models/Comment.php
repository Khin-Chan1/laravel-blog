<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $guarded = [];

    public function blog() { //blog_id
        return $this->belongsTo(Blog::class);
    }

    public function author() { //author_id
        return $this->belongsTo(User::class, 'user_id'); //to use user_id
    }
}
