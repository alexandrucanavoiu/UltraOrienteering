<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelayParticipantsStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relay_participant_stages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('relay_participant_id');
            $table->foreign('relay_participant_id')->references('id')->on('relay_participants');
            $table->unsignedInteger('relay_participant_managers_id');
            $table->foreign('relay_participant_managers_id')->references('id')->on('relay_participant_managers');
            $table->unsignedInteger('uuidcards_id');
            $table->foreign('uuidcards_id')->references('id')->on('uuidcards');
            $table->unsignedInteger('stages_id');
            $table->foreign('stages_id')->references('id')->on('stages');
            $table->unsignedInteger('relay_categories_id');
            //$table->foreign('relay_categories_id')->references('id')->on('relay_categories');
            $table->unsignedInteger('relay_category_managers_id');
            //$table->foreign('relay_category_managers_id')->references('id')->on('relay_category_managers');
            $table->unsignedInteger('routes_id');
            $table->foreign('routes_id')->references('id')->on('routes');
            $table->string('start_time');
            $table->string('finish_time');
            $table->string('total_time');
            $table->integer('abandon')->default(1);
            $table->text('missed_posts');
            $table->text('order_posts');
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
        Schema::dropIfExists('relay_participant_stages');
    }
}
