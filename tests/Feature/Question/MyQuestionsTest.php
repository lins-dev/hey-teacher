<?php
use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

#artisan test --filter=MyQuestions

# artisan test --filter "should be able to list all questions created by me"
it('should be able to list all questions created by me', function () {

    #Arrange
    $user      = User::factory()->create();
    $questions = Question::factory(10)->for($user, 'createdBy')->create();

    $wrongUser      = User::factory()->create();
    $wrongQuestions = Question::factory(10)->for($wrongUser, 'createdBy')->create();

    #Act
    actingAs($user);
    $response = get(route('questions.index'));

    #Assert
    foreach($questions as $question) {
        $response->assertSee($question->question);
    }

    foreach($wrongQuestions as $question) {
        $response->assertDontSee($question->question);
    }

});
