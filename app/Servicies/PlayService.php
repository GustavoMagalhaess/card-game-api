<?php

namespace App\Servicies;

use App\Models\Players;
use App\Models\PlayersScores;
use App\Rules\ValidCards;

class PlayService
{
    private string $player_name;
    private string $player_hand;
    private array $scaned_hand;
    private array $generated_hand;
    private array $player_score;

    /**
     * PlayService constructor.
     *
     * @param string $player_name
     * @param string $player_hand
     */
    public function __construct(string $player_name, string $player_hand) {
        $this->player_name = $player_name;
        $this->player_hand = $player_hand;
    }

    /**
     * Plays the game.
     *
     * Generates a new hand to compare with player's hand, then stores the both hands into db.
     *
     * @return array
     */
    public function play(): array
    {
        $this->scanPlayerHand();
        $this->generateHand();
        $this->compareHands();

        return $this->player_score;
    }

    /**
     * Scans player hand to get cards and length of cards.
     */
    private function scanPlayerHand(): void
    {
        $arr_cards = explode(' ', $this->player_hand);
        $length = count($arr_cards);

        $this->scaned_hand = [
            'cards' => $this->cardsToUpper($arr_cards),
            'length' => $length
        ];
    }

    /**
     * Transform letter cards to uppercase.
     *
     * @param array $cards
     *
     * @return array
     */
    private function cardsToUpper(array $cards): array
    {
        return array_map(static fn($card) => strtoupper($card), $cards);
    }

    /**
     * Generates a hand with same player's cards length
     */
    private function generateHand(): void
    {
        $valid_cards = collect(ValidCards::VALID_CARDS);

        for ($i = 0; $i < $this->scaned_hand['length']; $i++) {
            $card = $valid_cards->random();
            $this->generated_hand[] = $card;
        }
    }

    /**
     * Change letter cards to numbers to make sum.
     *
     * @param array $cards
     *
     * @return array
     */
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

    /**
     * Compares player's hand with generated hand and counts the scores.
     */
    private function compareHands(): void
    {
        $player = 0;
        $generated = 0;

        $player_cards = $this->changeCardValues($this->scaned_hand['cards']);
        $generated_cards = $this->changeCardValues($this->generated_hand);

        for ($i = 0; $i < $this->scaned_hand['length']; $i++) {
            if ($player_cards[$i] > $generated_cards[$i]) {
                $player++;
            }
            if ($player_cards[$i] < $generated_cards[$i]) {
                $generated++;
            }
        }

        $this->player_score = [
            'player' => ucwords($this->player_name),
            'score' => [
                'player' => $player,
                'generated' => $generated,
                'is_winner' => $player > $generated
            ]
        ];
    }

    /**
     * Saves a player and own scores.
     *
     * @param $player
     */
    public function save($player)
    {
        if (!$player) {
            $player = new Players();
            $player->name = strtolower($this->player_name);
            $player->save();
        }

        $score = new PlayersScores();
        $score->player_id = $player->id;
        $score->player_hand = $this->player_hand;
        $score->generated_hand = implode(' ', $this->generated_hand);
        $score->player_score = $this->player_score['score']['player'];
        $score->generated_score = $this->player_score['score']['generated'];
        $score->is_winner = $this->player_score['score']['is_winner'];

        $score->save();
    }
}
