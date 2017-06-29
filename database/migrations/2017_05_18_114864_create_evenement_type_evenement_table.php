<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvenementTypeEvenementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenement_type_evenement', function (Blueprint $table) {
            $table->integer('evenement_id')->unsigned();
            $table->integer('type_evenement_id')->unsigned();

            #foreign keys
            $table->foreign('evenement_id')->references('id')->on('evenements');
            $table->foreign('type_evenement_id')->references('id')->on('type_evenement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evenement_type_evenement');
    }
}
