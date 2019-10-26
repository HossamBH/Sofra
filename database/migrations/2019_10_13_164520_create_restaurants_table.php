<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('image');
			$table->float('delivery');
			$table->integer('min_charge');
			$table->enum('status', array('closed', 'opened'));
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->string('api_token', 60)->unique()->nullable();
			$table->string('pin_code')->nullable();
			$table->integer('neighborhood_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}