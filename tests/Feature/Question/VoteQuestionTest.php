<?php
use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

#artisan test --filter=VoteQuestionTest

# artisan test --filter "should be possible like a question"
it('should be possible like a question', function () {
    //Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //Act
    actingAs($user);
    post(route("votes.like", $question->uuid), $question->toArray());

    //Assert

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'question_id' => $user->id,
        'rating'      => 1,
    ]);
});
