<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    // Allow mass assignment on these fields
    protected $fillable = [
        'name',
        'team',
        'position',
        'image',
        'highlight_url',
        'afrobeats_track',
        'points_per_game',
        'assists_per_game',
        'rebounds_per_game',
    ];

    // Define relationship: which users liked this player
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'player_user');
    }
}
