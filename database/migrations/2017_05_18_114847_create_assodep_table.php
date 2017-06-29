<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssodepTable extends Migration {

	public function up()
	{
		Schema::create('assodep', function(Blueprint $table) {
			$table->increments('id');
			$table->string('numero_ad', 5);
			$table->string('ad_name', 50);
			$table->integer('antenne_id')->unsigned();

			#foreign key
			$table->foreign('antenne_id')->references('id')->on('antennes');

		});
	}

	public function down()
	{
		Schema::dropIfExists('assodep');
	}
}