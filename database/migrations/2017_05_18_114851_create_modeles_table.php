<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModelesTable extends Migration {

	public function up()
	{
		Schema::create('modeles', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('marque_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->string('name_modele', 30);

			#foreigne keys
			$table->foreign('marque_id')->references('id')->on('marques');
			$table->foreign('category_id')->references('id')->on('categories');
		});
	}

	public function down()
	{
		Schema::dropIfExists('modeles');
	}
}