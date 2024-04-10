<?php

namespace App\Http\Controllers;

use App\Actions\Votes\RegisterLikeAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function like(Request $request, string $questionUuid): RedirectResponse
    {

        RegisterLikeAction::handle($questionUuid);

        return back();
    }
}
