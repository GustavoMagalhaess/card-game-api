<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameFormRequest;
use App\Services\GameService;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    private GameService $service;

    /**
     * GameController constructor.
     *
     * @param GameService $service
     */
    public function __construct(GameService $service) {
        $this->service = $service;
    }

    /**
     * Returns a json response.
     *
     * @param array $data
     * @param int   $status
     * @param array $headers
     * @param int   $options
     *
     * @return JsonResponse
     */
    private function json($data = [], $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * Returns all winner's score.
     *
     * @return JsonResponse
     */
    public function winners(): JsonResponse
    {
        $scores = $this->service->getWinners();

        return $this->json($scores);
    }

    /**
     * Plays the game.
     *
     * Generates a new hand to compare with player's hand, then stores the both hands into db.
     *
     * @param GameFormRequest $request
     *
     * @return JsonResponse
     */
    public function play(GameFormRequest $request)
    {
        $player_name = $request->get('name');
        $player_hand = $request->get('hand');

        $score = $this->service->play($player_name, $player_hand);

        return $this->json($score);
    }
}
