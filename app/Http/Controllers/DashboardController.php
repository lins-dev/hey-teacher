<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'questions' => Question::with([
                'votes',
            ])
            ->withCount([
                'votes', 'votes as like_count' => function (Builder $query) {
                    $query->where('rating', '=', 1);
                },
                'votes', 'votes as dislike_count' => function (Builder $query) {
                    $query->where('rating', '=', 0);
                },
            ])
            ->paginate(5),
        ]);
    }
}
