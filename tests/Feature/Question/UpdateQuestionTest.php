<?php
use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

#artisan test --filter=UpdateQuestionTest

# artisan test --filter "should be able to update a question"
it('should be able to update a question', function () {

    //Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create(['created_by' => $user->id]);
    dump($question->toArray());

    //Act
    actingAs($user);

    //Assert
    put(route('questions.update', $question->uuid), [
        'question' => 'Updated Question?',
    ])->assertRedirect();

    $question->refresh();

    expect($question)->question->toBe('Updated Question?');
});

# artisan test --filter "should make sure that only question with status DRAFT can be updated"
it('should make sure that only question with status DRAFT can be updated', function () {

    //Arrange
    $user          = User::factory()->create();
    $questionDraft = Question::factory()->create([
        'created_by' => $user->id,
        'is_draft'   => true,
    ]);
    $questionPublished = Question::factory()->create([
        'created_by' => $user->id,
        'is_draft'   => false,
    ]);
    dump($questionDraft->toArray());
    dump($questionPublished->toArray());

    //Act
    actingAs($user);

    //Assert
    put(route('questions.update', $questionPublished->uuid), [
        'question' => 'Updated Question?',
    ])->assertForbidden();

    put(route('questions.update', $questionDraft->uuid), [
        'question' => 'Updated Question?',
    ])->assertRedirect();
});

# artisan test --filter "should make sure that only the user who as created the question can update the question"
it('should make sure that only the user who as created the question can update the question', function () {

    #Arrange
    $correctUser = User::factory()->create();
    $wrongUser   = User::factory()->create();

    $question = Question::factory()->create(['created_by' => $correctUser->id]);

    #Act
    actingAs($wrongUser);

    put(route('questions.update', $question->uuid), [
        'question' => 'Updated Question?',
    ])->assertForbidden();

    actingAs($correctUser);

    put(route('questions.update', $question->uuid), [
        'question' => 'Updated Question?',
    ])->assertRedirect();

    #Assert

});
