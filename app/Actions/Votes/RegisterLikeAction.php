<?php

namespace App\Actions\Votes;

use App\Models\Question;
use App\Models\Vote;

class RegisterLikeAction
{
    public static function handle(string $questionUuid): Vote
    {

        $question = Question::query()->where('uuid', '=', $questionUuid)->firstOrFail();

        $vote = Vote::firstOrCreate([
            'question_id' => $question->id,
        ]);

        $vote->update([
            'like' => $vote->like + 1,
        ]);

        return $vote;

    }

}
