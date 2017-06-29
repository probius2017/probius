<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBauxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baux', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_document', 20);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_signature');
            $table->string('duree_ini');
            $table->boolean('tacite_reconduction');
            $table->string('reconduction_description');
            $table->enum('clause', array('résiliation', 'résolutoire'));
            $table->string('description_clause');
            $table->tinyInteger('quantite_site')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baux');
    }
}
