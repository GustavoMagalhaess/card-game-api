<?php

namespace App\Http\Controllers;

use App\Models\UsersScores;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Returns all winner's score.
     *
     * @return JsonResponse
     */
    public function scores(): JsonResponse
    {
        $scores = UsersScores::query()
            ->with(['hands'])
            ->selectRaw('COUNT(users_scores.id) AS count, user_name')
            ->join('users_hands', 'users_scores.id', '=', 'users_hands.user_score_id')
            ->groupBy(['users_scores.user_name'])
            ->orderBy('count', 'DESC')
            ->orderBy('users_scores.user_name', 'ASC')
            ->get();



        return response()->json($scores);
    }
}
