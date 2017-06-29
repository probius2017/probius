<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeEvenementTable extends Migration {

	public function up()
	{
		Schema::create('type_evenement', function(Blueprint $table) {
			$table->increments('id');
			$table->string('event', 50);
		});
	}

	public function down()
	{
		Schema::dropIfExists('type_evenement');
	}
}