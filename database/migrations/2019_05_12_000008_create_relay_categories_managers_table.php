<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelayCategoriesManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relay_categories_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('relay_category_id');
            $table->foreign('relay_category_id')->references('id')->on('relay_categories');
            $table->unsignedInteger('routes_id');
            $table->foreign('routes_id')->references('id')->on('routes');
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
        Schema::dropIfExists('relay_categories_managers');
    }
}
