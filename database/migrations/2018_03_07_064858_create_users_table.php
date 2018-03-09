<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->boolean('active')->default(0);
            $table->rememberToken();
			$table->timestamps();
		});
		DB::table('users')->insert(array(
            'name' => 'fianr5750',
            'email' => 'fianr5750@gmail.com',
            'password' => bcrypt('721355'),
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('area', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->boolean('active')->default(0);
            $table->timestamps();
        });
        DB::table('area')->insert(array(
            'name' => 'semua area',
            'alias' => 'all',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        DB::table('area')->insert(array(
            'name' => 'jakarta pusat',
            'alias' => 'jktp',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        DB::table('area')->insert(array(
            'name' => 'makassar',
            'alias' => 'mks',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
		Schema::create('group', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->boolean('active')->default(0);
			$table->timestamps();
		});
        DB::table('group')->insert(array(
            'name' => 'hq',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
		Schema::create('status', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->boolean('active')->default(0);
			$table->timestamps();
		});
        DB::table('status')->insert(array(
            'name' => 'uploaded',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        DB::table('status')->insert(array(
            'name' => 'rejected',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        DB::table('status')->insert(array(
            'name' => 'approved',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
		Schema::create('product', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->boolean('active')->default(0);
			$table->timestamps();
		});
        DB::table('product')->insert(array(
            'name' => 'Tidak Ada POP',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        DB::table('product')->insert(array(
            'name' => 'POP Standar_Showcase_Standar',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        DB::table('product')->insert(array(
            'name' => 'POP Standar_Showcase_Corner/Lightbox Corner',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        DB::table('product')->insert(array(
            'name' => 'POP Standar_Showcase_Dealer(3 Level)',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
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
        DB::table('store')->insert(array(
            'dealer_id' => 'JXS36636',
            'name' => 'SULSEL-MKS01-OS-S-O-MTC-OPPO STORE-BLAZT',
            'address' => 'KAREBOSI LINK BLOK M39-M40, L52',
            'area_id' => '1',
            'grade' => 'C',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
        DB::table('store')->insert(array(
            'dealer_id' => 'JXS23648',
            'name' => 'BDO-SMI-PRIBADI UTAMA KOMUNIKA CV_CIANJUR',
            'address' => 'JL. SITI JENAB NO 44 CIANJUR',
            'area_id' => '2',
            'grade' => 'A',
            'active' => '1',
            'created_at' => DB::raw('now()')
        ));
		Schema::create('detail_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('area_id')->unsigned();
			$table->foreign('area_id')->references('id')->on('area')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('group_id')->unsigned();
			$table->foreign('group_id')->references('id')->on('group')
						->onDelete('cascade')
						->onUpdate('no action');
			$table->timestamps();
		});
        DB::table('detail_user')->insert(array(
            'user_id' => '1',
            'area_id' => '2',
            'group_id' => '1',
            'created_at' => DB::raw('now()')
        ));
		Schema::create('pop', function(Blueprint $table) {
			$table->increments('id');
			$table->boolean('periode')->default(0);
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('user_id')->on('detail_user')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('area_id')->unsigned();
			$table->foreign('area_id')->references('area_id')->on('detail_user')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('group_id')->unsigned();
			$table->foreign('group_id')->references('group_id')->on('detail_user')
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
		Schema::create('detail_pop', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('pop_id')->unsigned();
			$table->foreign('pop_id')->references('id')->on('pop')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('product')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('qty');
			$table->timestamps();
		});
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
		Schema::create('product_store', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('store_id')->unsigned();
			$table->foreign('store_id')->references('id')->on('store')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('product')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('qty');
			$table->timestamps();
		});
		Schema::create('move', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('from_store_id')->unsigned();
			$table->foreign('from_store_id')->references('id')->on('store')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('area_id')->unsigned();
			$table->foreign('area_id')->references('area_id')->on('detail_user')
						->onDelete('no action')
						->onUpdate('no action');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('user_id')->on('detail_user')
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

	public function down()
	{
		Schema::drop('users');
        Schema::drop('password_resets');
        Schema::drop('area');
		Schema::drop('group');
		Schema::drop('status');
		Schema::drop('detail_user');
		Schema::drop('pop');
		Schema::drop('detail_pop');
		Schema::drop('photo_pop');
		Schema::drop('store');
		Schema::drop('product_store');
		Schema::drop('move');
		Schema::drop('detail_move');
	}
}