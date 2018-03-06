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

        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('area_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('area_id')->unsigned()->default(0);
            $table->foreign('area_id')->references('id')->on('areas');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('sub_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->default(0);
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->string('name');
            $table->string('url');
            $table->string('icon');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('menu_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('menu_id')->unsigned()->default(0);
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        DB::table('users')->insert(array(
            'name' => 'fianr5750',
            'email' => 'fianr5750@gmail.com',
            'active' => '1',
            'password' => bcrypt('721355'),
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('areas')->insert(array(
            'name' => 'all',
            'alias' => 'all',
            'active' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('areas')->insert(array(
            'name' => 'jakarta pusat',
            'alias' => 'jktp',
            'active' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('area_users')->insert(array(
            'user_id' => '1',
            'area_id' => '1',
            'active' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('menus')->insert(array(
            'name' => 'Dashboard',
            'icon' => '-',
            'active' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('sub_menus')->insert(array(
            'menu_id' => '1',
            'name' => 'dashboard 1',
            'url' => '#',
            'icon' => '-',
            'active' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));

        DB::table('menu_users')->insert(array(
            'user_id' => '1',
            'menu_id' => '1',
            'active' => '1',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()')
        ));


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('menu_users');
        Schema::dropIfExists('sub_menus');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('area_users');
        Schema::dropIfExists('areas');
    }
}
