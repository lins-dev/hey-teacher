<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateResquest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
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
        $data = $request->validated();
        Question::create($data);

        return to_route('dashboard');
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
}
