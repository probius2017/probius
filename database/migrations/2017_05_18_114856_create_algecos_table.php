<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlgecosTable extends Migration {

	public function up()
	{
		Schema::create('algecos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('ad_id')->unsigned();
			$table->integer('bail_id')->unsigned();
			$table->enum('type_algeco', array('Bungalow', 'Chalet bois'));
			$table->string('ville_algeco', 100);
			$table->string('cp_algeco', 5);
			$table->string('adresse_algeco', 100);
			$table->string('apptEscalier', 100);
			$table->string('complementGeographique', 100);
			$table->timestamps();

			#foreigne keys
			$table->foreign('ad_id')->references('id')->on('assodep');
			$table->foreign('bail_id')->references('id')->on('baux');
		});
	}

	public function down()
	{
		Schema::dropIfExists('algecos');
	}
}