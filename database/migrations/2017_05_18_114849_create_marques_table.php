<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarquesTable extends Migration {

	public function up()
	{
		Schema::create('marques', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_marque', 30);
		});
	}

	public function down()
	{
		Schema::dropIfExists('marques');
	}
}