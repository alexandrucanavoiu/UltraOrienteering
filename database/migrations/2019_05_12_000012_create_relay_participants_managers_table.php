<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelayParticipantsManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relay_participant_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('relay_participant_id');
            //$table->foreign('relay_participant_id')->references('id')->on('relay_participants');
            $table->string('participant_name');
            $table->unsignedInteger('uuidcards_id');
            $table->foreign('uuidcards_id')->references('id')->on('uuidcards');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relay_participant_managers');
    }
}
