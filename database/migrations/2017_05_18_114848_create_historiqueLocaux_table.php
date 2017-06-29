<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoriqueLocauxTable extends Migration {

	public function up()
	{
		Schema::create('historiqueLocaux', function(Blueprint $table) {
			$table->increments('id');
			$table->string('ad', 15);
			$table->string('ville_local', 50);
			$table->string('cp_local', 5);
			$table->string('adresse_local', 200);
			$table->string('apptEscalier', 200);
			$table->string('complementGeographique', 200);
			$table->string('superficie', 15);
			$table->string('structure');
			$table->date('date_fin');
			$table->date('date_resiliation');
			$table->text('motif')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('historiqueLocaux');
	}
}