<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_structure', function (Blueprint $table) {
            $table->integer('local_id')->unsigned()->nullable();
            $table->integer('structure_id')->unsigned()->nullable();

            #foreign keys
            $table->foreign('local_id')->references('id')->on('locaux')->onDelete('SET NULL');
            $table->foreign('structure_id')->references('id')->on('structures')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_structure');
    }
}
