<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pop', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('periode_id')->unsigned();
            $table->foreign('periode_id')->references('id')->on('periode')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('store')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->boolean('posisi')->default(0);
            $table->boolean('ukuran')->default(0);
            $table->string('note')->nullable();
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('pop');
    }
}
