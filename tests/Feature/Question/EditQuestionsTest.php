<?php
use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

#artisan test --filter=EditQuestionTest

# artisan test --filter "should be able to open a question to edit"
it('should be able to open a question to edit', function () {

    //Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create(['created_by' => $user->id]);
    dump($question->toArray());

    //Act
    actingAs($user);
    $response = get(route('dashboard'));

    //Assert
    get(route('questions.edit', $question->uuid))
        ->assertSuccessful();
});
