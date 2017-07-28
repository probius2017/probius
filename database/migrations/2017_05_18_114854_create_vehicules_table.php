<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVehiculesTable extends Migration {

	public function up()
	{
		Schema::create('vehicules', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('ad_id')->unsigned();
			$table->integer('modele_id')->unsigned();
			$table->integer('marque_id')->unsigned();
			$table->integer('contrat_v_id')->unsigned()->unique();
			$table->string('immat', 10)->unique();
			$table->string('old_immat', 10)->unique()->nullable();
			$table->date('pmc');
			$table->date('atp');
			$table->timestamp('date_delete')->nullable()->default(null);
			$table->timestamps();

			#foreigne keys
			$table->foreign('ad_id')->references('id')->on('assodep');
			$table->foreign('modele_id')->references('id')->on('modeles');
			$table->foreign('marque_id')->references('id')->on('marques');
			$table->foreign('contrat_v_id')->references('id')->on('contrat_v')->onDelete('CASCADE');
		});
	}

	public function down()
	{
		Schema::dropIfExists('vehicules');
	}
}