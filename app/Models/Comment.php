<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Comment extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['post_id', 'user_id', 'content'];

    // Relationships
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Required method for Spatie LogsActivity
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['post_id', 'user_id', 'content'])
            ->logOnlyDirty()
            ->useLogName('comment')
            ->setDescriptionForEvent(fn(string $eventName) => "Comment has been {$eventName}");
    }
}
