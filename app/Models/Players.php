<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;

    protected $table = 'players';

    public $timestamps = false;

    protected $visible = ['name', 'scores'];

    /**
     * Gets the user's scores.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany(PlayersScores::class, 'player_id', 'id');
    }
}
