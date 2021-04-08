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

    protected $fillable = ['name'];

    /**
     * Gets the user's scores.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany(PlayersScores::class, 'player_id', 'id');
    }

    /**
     * Sets name filed to lowercase.
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * Get name filed to ucfirst.
     *
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
