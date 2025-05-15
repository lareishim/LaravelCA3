<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'player_id',
    ];

    /**
     * The user who made the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The player the post is about (optional).
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
