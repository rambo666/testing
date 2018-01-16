<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function ($table) {

            $table->increments('id');
            $table->integer('activity_id')->unsigned();
             $table->integer('destination_id')->unsigned();
            $table->string('title');
            $table->text('overview');
            $table->string('slug')->nullable;
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('image_path')->nullable();
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
        //
    }
}
