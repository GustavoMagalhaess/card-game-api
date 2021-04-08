<?php

namespace App\Repositories;
use App\Models\UsersScores;
use Illuminate\Database\Eloquent\Collection;

class GameRepository
{
    /**
     * Returns all winner's score.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWinnersScores(): Collection
    {
        $scores = UsersScores::with(['hands' => function ($query) {
            $query->select(['users_hands.id',
                            'users_hands.user_score_id' ,
                            'users_hands.user_hand']);
        }])
            ->select(['users_scores.id', 'users_scores.user_name'])
            ->winners();

        return $scores->get();
    }
}
