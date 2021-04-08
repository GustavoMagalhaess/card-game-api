<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_hands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_score_id');
            $table->foreign('user_score_id')->references('id')->on('users_scores');
            $table->string('user_hand')->nullable(false);
            $table->string('generated_hand')->nullable(false);
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
        Schema::dropIfExists('users_hands');
    }
}
