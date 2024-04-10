<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function like(Request $request, string $questionUuid): RedirectResponse
    {

        $question = Question::query()->where('uuid', '=', $questionUuid)->firstOrFail();
        auth()->user()->like($question);

        return back();
    }

    public function dislike(Request $request, string $questionUuid): RedirectResponse
    {

        $question = Question::query()->where('uuid', '=', $questionUuid)->firstOrFail();
        auth()->user()->dislike($question);

        return back();
    }
}
