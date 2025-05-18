<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use HasFactory, LogsActivity;

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

    /**
     * The comments on the post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Spatie activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'content', 'player_id'])
            ->logOnlyDirty()
            ->useLogName('post')
            ->setDescriptionForEvent(fn(string $eventName) => "Post has been {$eventName}");
    }
}
