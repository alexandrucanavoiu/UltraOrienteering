<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('participant_id');
            $table->foreign('participant_id')->references('id')->on('participants');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedInteger('uuid_card_id');
            $table->foreign('uuid_card_id')->references('id')->on('uuid_cards');
            $table->unsignedInteger('stage_id');
            $table->foreign('stage_id')->references('id')->on('stages');

            $table->time('post_start');
            $table->time('post_1')->default('00:00:00');
            $table->time('post_2')->default('00:00:00');
            $table->time('post_3')->default('00:00:00');
            $table->time('post_4')->default('00:00:00');
            $table->time('post_5')->default('00:00:00');
            $table->time('post_6')->default('00:00:00');
            $table->time('post_7')->default('00:00:00');
            $table->time('post_8')->default('00:00:00');
            $table->time('post_9')->default('00:00:00');
            $table->time('post_10')->default('00:00:00');
            $table->time('post_11')->default('00:00:00');
            $table->time('post_12')->default('00:00:00');
            $table->time('post_finish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_managers');
    }
}
