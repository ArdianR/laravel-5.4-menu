<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoMoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_move', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('move_id')->unsigned();
            $table->foreign('move_id')->references('id')->on('move')
                        ->onDelete('cascade')
                        ->onUpdate('no action');
            $table->boolean('type')->default(0);
            $table->string('photo');
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
