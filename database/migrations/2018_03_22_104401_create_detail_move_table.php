<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailMoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_move', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('move_id')->unsigned();
            $table->foreign('move_id')->references('id')->on('move')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->integer('qty');
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
        Schema::dropIfExists('detail_move');
    }
}
