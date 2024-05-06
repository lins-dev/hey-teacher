<?php
use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

#artisan test --filter=PublishQuestion

# artisan test --filter "should be able to publish a question"
it('should be able to publish a question', function () {
    # Arrange

    $user     = User::factory()->create();
    $question = Question::factory()->create(['created_by' => $user->id]);

    # Act
    actingAs($user);

    put(route('questions.publish', $question->uuid))->assertRedirect();
    $question->refresh();
    dump($question->toArray());

    # Assert
    expect($question->is_draft)->toBeFalse();
});

# artisan test --filter "should make sure that only the user who as created the question can publish the question"
it('should make sure that only the user who as created the question can publish the question', function () {

    #Arrange
    $correctUser = User::factory()->create();
    $wrongUser   = User::factory()->create();

    $question = Question::factory()->create(['created_by' => $correctUser->id]);

    #Act
    actingAs($wrongUser);

    put(route('questions.publish', $question->uuid))->assertForbidden();

    actingAs($correctUser);

    put(route('questions.publish', $question->uuid))->assertRedirect();

    #Assert

});
