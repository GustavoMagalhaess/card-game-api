<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_scores', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 250)->nullable(false);
            $table->unsignedTinyInteger('user_score')->nullable(false)->default(0);
            $table->unsignedTinyInteger('generated_score')->nullable(false)->default(0);
            $table->boolean('is_user_winner')->nullable(false)->default(false);
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
        Schema::dropIfExists('users_scores');
    }
}
