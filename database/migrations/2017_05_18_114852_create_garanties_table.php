<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGarantiesTable extends Migration {

	public function up()
	{
		Schema::create('garanties', function(Blueprint $table) {
			$table->increments('id');
			$table->string('reference', 30);
		});
	}

	public function down()
	{
		Schema::dropIfExists('garanties');
	}
}