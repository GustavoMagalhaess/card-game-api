<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameFormRequest;
use App\Servicies\GameService;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    private $service;

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
    public function winnersScores(): JsonResponse
    {
        $scores = $this->service->getWinnersScores();

        return $this->json($scores);
    }

    public function generateHand(GameFormRequest $request)
    {
        $generated_hand = $this->service->generateHand($request->all());

        //return $this->json($generated_hand);
    }
}
