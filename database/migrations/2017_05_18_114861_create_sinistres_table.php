<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSinistresTable extends Migration {

	public function up()
	{
		Schema::create('sinistres', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contrat_id')->unsigned()->nullable();
			$table->integer('type_sinistre_id')->unsigned();
			$table->integer('contrat_v_id')->unsigned()->nullable();
			$table->string('ref_rdc', 20)->unique();
			$table->string('ref_macif', 20);
			$table->date('date_reception');
			$table->date('date_ouverture');
			$table->date('date_sinistre');
			$table->string('ville_sinistre', 50);
			$table->string('cp_sinistre', 5);
			$table->string('responsabilite', 4);
			$table->string('observation');
			$table->decimal('reglement_macif');
			$table->decimal('franchise');
			$table->decimal('solde_ad');
			$table->date('date_cloture')->nullable()->default(null);
			$table->timestamps();

			#foreigne keys
			$table->foreign('type_sinistre_id')->references('id')->on('type_sinistre');
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('SET NULL');
			$table->foreign('contrat_v_id')->references('id')->on('contrat_v')->onDelete('SET NULL');
		});
	}

	public function down()
	{
		Schema::dropIfExists('sinistres');
	}
}