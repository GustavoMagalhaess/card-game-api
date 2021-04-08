<?php

namespace App\Servicies;
use App\Repositories\GameRepository;
use App\Rules\ValidCards;

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

    public function play(string $player_name, string $player_hand)
    {
        $scaned_hand = $this->scanPlayerHand($player_hand);
        $generated_hand = $this->generateHand($scaned_hand['length']);
        $score = $this->compareHands($scaned_hand['cards'], $generated_hand, $scaned_hand['length']);

        $player_score = [
            'name' => $player_name,
            'score' => $score
        ];

        return $player_score;
    }

    private function scanPlayerHand(string $player_hand): array
    {
        $cards = explode(' ', $player_hand);
        $length = count($cards);

        return [
            'cards' => $cards,
            'length' => $length
        ];
    }

    private function generateHand(int $length): array
    {
        $valid_cards = collect(ValidCards::VALID_CARDS);

        for ($i = 0; $i < $length; $i++) {
            $card = $valid_cards->random();
            $generated_hand[] = $card;
        }

        return $generated_hand;
    }

    private function changeCardValues(array $cards): array
    {
        $new_cards = array_map(function ($card) {
            if ($card === 'J') {
                return "11";
            }

            if ($card === 'Q') {
                 return "12";
            }

            if ($card === 'K') {
                return "13";
            }

            if ($card === 'A') {
                return "14";
            }

            return $card;
        }, $cards);

        return $new_cards;
    }

    private function compareHands(array $player_hand, array $generated_hand, int $length): array
    {
        $player = 0;
        $generated = 0;

        $player_cards = $this->changeCardValues($player_hand);
        $generated_cards = $this->changeCardValues($generated_hand);

        for ($i = 0; $i < $length; $i++) {
            if ($player_cards[$i] > $generated_cards[$i]) {
                $player++;
            }
            if ($player_cards[$i] < $generated_cards[$i]) {
                $generated++;
            }
        }

        return ['player' => $player, 'generated' => $generated];
    }
}
