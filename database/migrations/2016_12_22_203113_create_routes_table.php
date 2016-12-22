<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->decimal('length_in_km', 8, 3);
            $table->integer('post_amount');
            $table->string('post_1');
            $table->string('post_2');
            $table->string('post_3');
            $table->string('post_4');
            $table->string('post_5');
            $table->string('post_6');
            $table->string('post_7');
            $table->string('post_8');
            $table->string('post_9');
            $table->string('post_10');
            $table->string('post_11');
            $table->string('post_12');
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
        Schema::dropIfExists('routes');
    }
}
