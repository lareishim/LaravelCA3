<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'is_active',
        'user_id',
    ];

    /**
     * The admin who posted the announcement.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Users who have seen the announcement.
     * Used only for marking announcements as seen.
     */
    public function seenByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('seen_at')
            ->withTimestamps();
    }
}
