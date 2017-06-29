<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratVTable extends Migration {

	public function up()
	{
		Schema::create('contrat_v', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('garantie_id')->unsigned();
			$table->string('numero_contratV', 50);
			$table->timestamps();

			#foreigne keys
			$table->foreign('garantie_id')->references('id')->on('garanties');
		});
	}

	public function down()
	{
		Schema::dropIfExists('contrat_v');
	}
}