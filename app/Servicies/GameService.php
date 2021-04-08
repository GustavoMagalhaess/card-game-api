<?php

namespace App\Servicies;
use App\Repositories\GameRepository;

class GameService
{
    private $repository;

    public function __construct(GameRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Returns all winner's score.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWinnersScores()
    {
        return $this->repository->getWinnersScores();
    }

    public function generateHand(array $request)
    {
        dd($request);
    }
}
