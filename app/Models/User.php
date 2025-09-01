<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // 'password' => 'hashed',
        ];
    }

    public function blogs() {
        return $this->hasMany(Blog::class);
    }

    public function getNameAttribute($value) {
        return ucwords($value);
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function subscribedBlogs() {
        return $this->belongsToMany(Blog::class);
    }

    public function isSubscribed($blog) {
        return $this->subscribedBlogs()->where('blog_id', $blog->id)->exists();
    }
}
