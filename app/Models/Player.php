<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Player extends Model
{
    use LogsActivity;

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

    // Spatie activity log options
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'team',
                'position',
                'image',
                'highlight_url',
                'afrobeats_track',
                'points_per_game',
                'assists_per_game',
                'rebounds_per_game',
            ])
            ->logOnlyDirty()
            ->useLogName('player')
            ->setDescriptionForEvent(fn(string $eventName) => "Player has been {$eventName}");
    }
}
