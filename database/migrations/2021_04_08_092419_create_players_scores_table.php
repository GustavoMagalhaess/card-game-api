<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players');
            $table->string('player_hand')->nullable(false);
            $table->string('generated_hand')->nullable(false);
            $table->unsignedTinyInteger('player_score')->nullable(false)->default(0);
            $table->unsignedTinyInteger('generated_score')->nullable(false)->default(0);
            $table->boolean('is_winner')->nullable(false)->default(false);
            $table->timestamp('created_at')->nullable(false)->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_scores');
    }
}
