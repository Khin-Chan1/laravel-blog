<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // protected $guarded = ['id']; opposite with $fillable>> can access to fill others except 'id'

    protected $fillable = ['title', 'intro', 'body'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
