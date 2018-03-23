<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function(Blueprint $table) {
            $table->increments('id');
            $table->string('dealer_id');
            $table->string('name');
            $table->string('address');
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area')
                        ->onDelete('no action')
                        ->onUpdate('no action');
            $table->string('grade');
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
        Schema::dropIfExists('store');
    }
}
