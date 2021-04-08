<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersHands extends Model
{
    use HasFactory;

    protected $table = 'users_hands';

    public $timestamps = false;

    public $visible = ['user_hand'];

    public function user()
    {
        return $this->belongsTo(UsersScores::class, 'user_score_id', 'id');
    }
}
