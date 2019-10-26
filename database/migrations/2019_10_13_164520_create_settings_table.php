<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->longText('about_us');
			$table->text('content');
			$table->text('text');
			$table->string('phone');
			$table->string('email');
			$table->string('fb_link')->nullable();
			$table->string('youtube_link')->nullable();
			$table->string('insta_link')->nullable();
			$table->string('twitter_link')->nullable();
			$table->string('whatsapp')->nullable();
			$table->float('commission');
			$table->float('maximum');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}