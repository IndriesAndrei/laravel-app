<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function likedBy(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }

    // a post can belong to a user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // a post can have many likes
    public function likes() {
        return $this->hasMany(Like::class);
    }
}
