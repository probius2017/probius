<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocauxTable extends Migration {

	public function up()
	{
		Schema::create('locaux', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('ad_id')->unsigned();
			$table->integer('bail_id')->unsigned();
			$table->integer('historiqueLocal_id')->unsigned()->nullable();
			$table->string('cp_local', 5);
			$table->string('ville_local', 50);
			$table->string('adresse_local', 200);
			$table->string('apptEscalier', 200);
			$table->string('complementGeographique', 200);
			$table->string('superficie', 15);
			$table->boolean('ERP');
			$table->boolean('precaire');
			$table->enum('etat_ini', array('parfait état', 'remise en état fin de bail'));
			$table->string('nom_bailleur', 20);
			$table->enum('info_bailleur', array('publique', 'privé', 'AN'));
			$table->decimal('loyer');
			$table->enum('detail_loyer', array('TVA', 'NET'));
			$table->decimal('prix_m2');
			$table->decimal('pret');
			$table->boolean('local_partage');
			$table->string('precision_partage');
			$table->string('accessibilite');
			$table->text('observation_generale');
			$table->string('charge_bailleur');
			$table->string('charge_rdc');
			$table->text('detail_charge');
			$table->string('contenu');
			$table->timestamps();

			#foreigne keys
			$table->foreign('ad_id')->references('id')->on('assodep');
			$table->foreign('bail_id')->references('id')->on('baux');
			$table->foreign('historiqueLocal_id')->references('id')->on('historiqueLocaux')->onDelete('SET NULL');
		});
	}

	public function down()
	{
		Schema::dropIfExists('locaux');
	}
}