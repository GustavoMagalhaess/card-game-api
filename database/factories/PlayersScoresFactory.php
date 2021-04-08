<?php

namespace Database\Factories;

use App\Models\PlayersScores;
use App\Models\Players;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayersScoresFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlayersScores::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $players = Players::pluck('id')->random();

        $cards = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        $hand_size = $this->faker->randomDigitNotZero();

        for ($i = 0; $i < $hand_size; $i++) {
            $card = $this->faker->randomElement($cards);
            $player_hand[] = $card;

            $card = $this->faker->randomElement($cards);
            $generated_hand[] = $card;
        }

        $player_score = $this->faker->numberBetween(0, 13);
        $generated_score = $this->faker->numberBetween(0, 13);

        return [
            'player_id' => $players,
            'player_hand' => implode(' ', $player_hand),
            'generated_hand' => implode(' ', $generated_hand),
            'player_score' => $player_score,
            'generated_score' => $generated_score,
            'is_winner' => $this->faker->boolean($player_score > $generated_score)
        ];
    }
}
