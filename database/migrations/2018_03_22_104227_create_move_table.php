<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->integer('from_store_id')->unsigned();
            $table->foreign('from_store_id')->references('id')->on('store')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->integer('to_store_id')->unsigned();
            $table->foreign('to_store_id')->references('id')->on('store')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->string('note');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status')
                        ->onDelete('no action')
                        ->onUpdate('no action');
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
        Schema::dropIfExists('move');
    }
}
