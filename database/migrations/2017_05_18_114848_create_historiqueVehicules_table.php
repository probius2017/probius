<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriqueVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiqueVehicules', function (Blueprint $table) {

            $table->increments('id');
            $table->string('ad', 15);
            $table->string('name_marque', 50);
            $table->string('name_modele', 50);
            $table->string('immat', 15);
            $table->date('date_resiliation');
            $table->text('motif')->nullable();
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
        Schema::dropIfExists('historiqueVehicules');
    }
}
