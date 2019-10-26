<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->text('description');
			$table->string('image');
			$table->datetime('start');
			$table->datetime('end');
			$table->integer('restaurant_id');
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}