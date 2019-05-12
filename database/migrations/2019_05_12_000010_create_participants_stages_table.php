<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants_stages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('participants_id');
            $table->foreign('participants_id')->references('id')->on('participants');
            $table->unsignedInteger('stages_id');
            $table->foreign('stages_id')->references('id')->on('stages');
            $table->unsignedInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->unsignedInteger('uuidcards_id');
            $table->foreign('uuidcards_id')->references('id')->on('uuidcards');
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
        Schema::dropIfExists('participants_stages');
    }
}
