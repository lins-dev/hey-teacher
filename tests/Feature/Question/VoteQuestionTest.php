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
        'user_id'     => $user->id,
        'rating'      => 1,
    ]);
});

# artisan test --filter "should not be able to like more than 1 time"
it('should not be able to like more than 1 time', function () {
    //Arrange
    $user     = User::factory()->create();
    $user2    = User::factory()->create();
    $question = Question::factory()->create();

    //Act
    actingAs($user);

    post(route("votes.like", $question->uuid), $question->toArray());
    post(route("votes.like", $question->uuid), $question->toArray());
    post(route("votes.like", $question->uuid), $question->toArray());
    post(route("votes.like", $question->uuid), $question->toArray());

    actingAs($user2);

    post(route("votes.like", $question->uuid), $question->toArray());
    post(route("votes.like", $question->uuid), $question->toArray());
    //Assert

    expect(
        $user->votes()
            ->where('question_id', '=', $question->id)
            ->where('user_id', '=', $user->id)
            ->get()
    )->toHaveCount(1);

    expect(
        $user2->votes()
            ->where('question_id', '=', $question->id)
            ->where('user_id', '=', $user2->id)
            ->get()
    )->toHaveCount(1);

    $question->votes()->each(function ($vote) {
        dump($vote->toArray());
    });

    expect(
        $question->votes()
            ->get()
    )->toHaveCount(2);
});

# artisan test --filter "should be possible dislike a question"
it('should be possible dislike a question', function () {
    //Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //Act
    actingAs($user);
    post(route("votes.dislike", $question->uuid), $question->toArray());

    //Assert

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'rating'      => 0,
    ]);
});

# artisan test --filter "should not be able to dislike more than 1 time"
it('should not be able to dislike more than 1 time', function () {
    //Arrange
    $user     = User::factory()->create();
    $user2    = User::factory()->create();
    $question = Question::factory()->create();

    //Act
    actingAs($user);

    post(route("votes.like", $question->uuid), $question->toArray());
    post(route("votes.like", $question->uuid), $question->toArray());
    post(route("votes.like", $question->uuid), $question->toArray());
    post(route("votes.like", $question->uuid), $question->toArray());

    actingAs($user2);

    post(route("votes.like", $question->uuid), $question->toArray());
    post(route("votes.like", $question->uuid), $question->toArray());
    //Assert

    expect(
        $user->votes()
            ->where('question_id', '=', $question->id)
            ->where('user_id', '=', $user->id)
            ->get()
    )->toHaveCount(1);

    expect(
        $user2->votes()
            ->where('question_id', '=', $question->id)
            ->where('user_id', '=', $user2->id)
            ->get()
    )->toHaveCount(1);

    $question->votes()->each(function ($vote) {
        dump($vote->toArray());
    });

    expect(
        $question->votes()
            ->get()
    )->toHaveCount(2);
});
