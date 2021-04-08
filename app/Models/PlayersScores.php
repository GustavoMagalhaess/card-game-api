<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayersScores extends Model
{
    use HasFactory;

    protected $table = 'players_scores';

    public $timestamps = false;

    protected $attributes = [
        'player_score' => 0,
        'generated_score' => 0,
        'is_winner' => false
    ];

    protected $visible = ['player_hand', 'generated_hand', 'player_score', 'generated_score'];

    /**
     * Gets the related player.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player()
    {
        return $this->belongsTo(Players::class, 'player_id', 'id');
    }

    /**
     * Scope to filter higher score users.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeWinners($query)
    {
        return $query->where('is_winner', 1);
    }
}
