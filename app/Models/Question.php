<?php

namespace App\Models;

use App\Observers\QuestionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(QuestionObserver::class)]
class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'question',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
