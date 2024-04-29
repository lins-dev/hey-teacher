<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateResquest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function index()
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

    public function store(CreateResquest $request): RedirectResponse
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question): void
    {
        //
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
