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
    $question = Question::factory()->create();

    # Act
    actingAs($user);

    put(route('questions.publish', $question->uuid))->assertRedirect();
    $question->refresh();
    dump($question->toArray());

    # Assert
    expect($question->is_draft)->toBeFalse();
});
