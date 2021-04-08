<?php

namespace App\Repositories;

use App\Models\Players;
use Illuminate\Database\Eloquent\Collection;

class GameRepository
{
    /**
     * Returns all winner's score.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWinners(): Collection
    {
        return Players::with(['scores' => function ($query) {
            $query->winners();
        }])->get();
    }

    public function getPlayer(string $name)
    {
        return Players::where('name' ,'=', $name)->first();
    }
}
