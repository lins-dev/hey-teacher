<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $fillable = [
        'question',
    ];

    public function uniqueIds(): array
    {
        //your new column name
        return ['uuid'];
    }

    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
