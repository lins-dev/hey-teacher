<?php
use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;

#artisan test --filter=DestroyQuestionTest

# artisan test --filter "should be able to destroy a question"
it('should be able to destroy a question', function () {
    # Arrange

    $user     = User::factory()->create();
    $question = Question::factory()->create(['created_by' => $user->id]);
    dump($question->toArray());

    # Act
    actingAs($user);

    delete(route('questions.destroy', $question->uuid))->assertRedirect();

    # Assert
    assertDatabaseMissing('questions', ['uuid' => $question->uuid, 'deleted_at' => null]);
});

# artisan test --filter "should make sure that only the user who as created the question can destroy the question"
it('should make sure that only the user who as created the question can destroy the question', function () {

    #Arrange
    $correctUser = User::factory()->create();
    $wrongUser   = User::factory()->create();

    $question = Question::factory()->create(['created_by' => $correctUser->id]);

    #Act
    actingAs($wrongUser);

    delete(route('questions.destroy', $question->uuid))->assertForbidden();

    actingAs($correctUser);

    delete(route('questions.destroy', $question->uuid))->assertRedirect();

    #Assert

});
