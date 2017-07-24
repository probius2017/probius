<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvenementsTable extends Migration {

	public function up()
	{
		Schema::create('evenements', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contrat_id')->unsigned()->nullable();
			$table->enum('statut_event', array('validé', 'non validé'))->default('non validé');
			$table->string('nom_salle', 50);
			$table->string('nom_event', 50);
			$table->date('date_demande');
			$table->date('date_reponse');
			$table->text('remarque');
			$table->timestamps();

			#foreigne keys
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('SET NULL');

		});
	}

	public function down()
	{
		Schema::dropIfExists('evenements');
	}
}