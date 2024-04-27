<?php
use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

# artisan test --filter "should list all questions"
it('should list all questions', function () {

    //Arrange
    $user      = User::factory()->create();
    $questions = Question::factory(5)->create();

    //Act
    actingAs($user);
    $response = get(route('dashboard'));

    //Assert
    $questions->each(function (Question $question) use ($response) {
        $response->assertSee($question->question);
    });
});
