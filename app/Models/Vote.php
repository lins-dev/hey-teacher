<?php

namespace App\Models;

use App\Observers\VoteObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(VoteObserver::class)]
class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'like',
        'dislike',
    ];
}
