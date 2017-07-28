<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeSinistreTable extends Migration {

	public function up()
	{
		Schema::create('type_sinistre', function(Blueprint $table) {
			$table->increments('id');
			$table->string('ref', 50);
		});
	}

	public function down()
	{
		Schema::dropIfExists('type_sinistre');
	}
}