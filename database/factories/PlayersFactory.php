<?php

namespace Database\Factories;

use App\Models\PlayersScores;
use App\Models\Players;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Players::class;

    public function configure()
    {
        return $this->afterCreating(function (Players $players, $faker){
            $collection = PlayersScores::factory(10)->create();
            $collection->each(fn($score) => $players->scores()->save($score));
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [ 'name' => $this->faker->firstName ];
    }
}
