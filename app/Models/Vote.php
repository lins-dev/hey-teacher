<?php

namespace App\Models;

use App\Observers\VoteObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(VoteObserver::class)]
class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'rating',
    ];

    public function rating(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return match ($value) {
                    0       => 'dislike',
                    default => 'like'
                };
            }
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
