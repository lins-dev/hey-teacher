<?php
use App\Models\Question;
use App\Models\User;

use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

# artisan test --filter=ListQuestionsTest

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

# artisan test --filter "should paginate the result"
it('should paginate the result', function () {

    //Arrange
    $user = User::factory()->create();
    Question::factory(30)->create();

    //Act
    actingAs($user);
    get(route('dashboard'))
        ->assertViewHas('questions', function ($value) {
            return $value instanceof LengthAwarePaginator;
        });

    //Assert
});
