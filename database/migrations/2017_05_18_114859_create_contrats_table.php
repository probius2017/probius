<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratsTable extends Migration {

	public function up()
	{
		Schema::create('contrats', function(Blueprint $table) {
			$table->increments('id');
			$table->string('num_contrat', 50);
			$table->string('name_contrat', 50);
			$table->string('intercalaire', 30)->nullable();
			$table->integer('type_contrat')->length(3)->unsigned();
			$table->integer('local_id')->unsigned()->nullable();
			$table->integer('algeco_id')->unsigned()->nullable();
			$table->integer('logement_id')->unsigned()->nullable();
			$table->timestamps();

			#foreign keys
            $table->foreign('local_id')->references('id')->on('locaux')->onDelete('SET NULL');
            $table->foreign('algeco_id')->references('id')->on('algecos')->onDelete('SET NULL');
            $table->foreign('logement_id')->references('id')->on('logements')->onDelete('SET NULL');
		});
	}

	public function down()
	{
		Schema::dropIfExists('contrats');
	}
}