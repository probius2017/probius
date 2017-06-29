<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStructuresTable extends Migration {

	public function up()
	{
		Schema::create('structures', function(Blueprint $table) {
			$table->increments('id');
			$table->string('type_structure', 30);
			$table->enum('RI', array('<=25', '>=25', '>=50'))->nullable();
		});
	}

	public function down()
	{
		Schema::dropIfExists('structures');
	}
}