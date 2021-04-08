<?php

namespace Database\Factories;

use App\Models\UsersHands;
use App\Models\UsersScores;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersScoresFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsersScores::class;

    public function configure()
    {
        return $this->afterCreating(function (UsersScores $usersScores, $faker){
            $collection = UsersHands::factory(10)->create();
            $collection->each(fn($item) => $usersScores->hands()->save($item));
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_score = $this->faker->numberBetween(0, 13);
        $generated_score = $this->faker->numberBetween(0, 13);

        return [
            'user_name' => $this->faker->firstName,
            'user_score' => $user_score,
            'generated_score' => $generated_score,
            'is_user_winner' => $this->faker->boolean($user_score > $generated_score)
        ];
    }
}
