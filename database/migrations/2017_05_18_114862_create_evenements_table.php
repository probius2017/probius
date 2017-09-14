<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvenementsTable extends Migration {

	public function up()
	{
		Schema::create('evenements', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom_salle', 50)->nullable();
			$table->string('adresse_event', 200)->nullable();
			$table->string('cp_event', 15);
			$table->string('ville_event', 100);
			$table->string('nom_event', 100)->nullable();
			$table->string('duree_event', 100)->nullable();
			$table->enum('type_event', ['Manif', 'Reunion']);
			$table->boolean('statut_event')->default(0);
			$table->date('date_demande');
			$table->date('date_reponse');
			$table->text('remarque')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('evenements');
	}
}