<?php

namespace App\Services;

use App\Repositories\GameRepository;

class GameService
{
    private GameRepository $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns all winner's score.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWinners()
    {
        return $this->repository->getWinners();
    }

    /**
     * Plays the game.
     *
     * Generates a new hand to compare with player's hand, then stores the both hands into db.
     *
     * @param string $player_name
     * @param string $player_hand
     *
     * @return array
     */
    public function play(string $player_name, string $player_hand): array
    {
        $playService  = new PlayService($player_name, $player_hand);
        $player_score = $playService->play();
        $player = $this->repository->getPlayerbyName($player_name);
        $playService->save($player);

        return $player_score;
    }
}
