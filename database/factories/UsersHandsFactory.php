<?php

namespace Database\Factories;

use App\Models\UsersHands;
use App\Models\UsersScores;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersHandsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsersHands::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cards = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        $hand_size = $this->faker->randomDigitNotZero();
        for ($i = 0; $i < $hand_size; $i++) {
            $card = $this->faker->randomElement($cards);
            $user_hand[] = $card;

            $card = $this->faker->randomElement($cards);
            $generated_hand[] = $card;
        }

        $users_scores = UsersScores::pluck('id')->random();

        return [
            'user_score_id' => $users_scores,
            'user_hand' => implode(' ', $user_hand),
            'generated_hand' => implode(' ', $generated_hand)
        ];
    }
}
