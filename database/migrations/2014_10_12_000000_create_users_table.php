<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('area', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('area_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_users')->unsigned()->default(0);
            $table->foreign('id_users')->references('id')->on('users');
            $table->integer('id_area')->unsigned()->default(0);
            $table->foreign('id_area')->references('id')->on('area');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('sub_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_menu')->unsigned()->default(0);
            $table->foreign('id_menu')->references('id')->on('menu');
            $table->string('name');
            $table->string('url');
            $table->string('icon');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('menu_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned()->default(0);
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_sub_menu')->unsigned()->default(0);
            $table->foreign('id_sub_menu')->references('id')->on('sub_menu');
            $table->string('icon');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('menu_user');
        Schema::dropIfExists('sub_menu');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('area_user');
        Schema::dropIfExists('area');
    }
}
