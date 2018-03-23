<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoPopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_pop', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pop_id')->unsigned();
            $table->foreign('pop_id')->references('id')->on('pop')
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
        Schema::dropIfExists('photo_pop');
    }
}
