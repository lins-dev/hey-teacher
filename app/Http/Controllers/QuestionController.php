<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateAndUpdateRequest;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions' => auth()->user()->questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    public function store(CreateAndUpdateRequest $request): RedirectResponse
    {
        $data               = $request->validated();
        $data['created_by'] = auth()->user()->id;
        Question::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question): void
    {
        //
    }

    public function edit(string $uuid): View
    {
        $question = Question::query()->where('uuid', '=', $uuid)->firstOrFail();
        Gate::authorize('update', $question);

        return view('question.edit', ['question' => $question]);
    }

    public function update(CreateAndUpdateRequest $request, string $uuid): RedirectResponse
    {
        $question = Question::query()->where('uuid', '=', $uuid)->firstOrFail();
        Gate::authorize('update', $question);
        $data = $request->validated();
        $question->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): RedirectResponse
    {
        try {
            $question = Question::query()->where('uuid', '=', $uuid)->firstOrFail();
        } catch (\Throwable $th) {
            return back(Response::HTTP_NOT_FOUND);
        }

        Gate::authorize('destroy', $question);
        $question->delete();

        return back();
    }

    public function publish(Request $request, string $uuid): RedirectResponse
    {
        $question = Question::query()->where('uuid', '=', $uuid)->firstOrFail();
        Gate::authorize('publish', $question);
        // abort_unless(auth()->user()->can('publish', $question), Response::HTTP_FORBIDDEN);

        $question->update([
            'is_draft' => false,
        ]);

        return back();
    }
}
