<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersScores extends Model
{
    use HasFactory;

    protected $table = 'users_scores';

    public $timestamps = false;

    protected $attributes = [
        'user_score' => 0,
        'generated_score' => 0,
        'is_user_winner' => false
    ];

    /**
     * Gets the user's hands played.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hands()
    {
        return $this->hasMany(UsersHands::class, 'user_score_id','id');
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
        return $query->where('users_scores.is_user_winner', 1);
    }
}
