<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommissionsTable extends Migration {

	public function up()
	{
		Schema::create('commissions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('paid');
			$table->date('payment_date');
			$table->integer('restaurant_id')->unsigned();
			$table->text('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('commissions');
	}
}