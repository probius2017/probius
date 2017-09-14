<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChambreFroideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chambresFroides', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id')->unsigned();
            $table->string('volume', 15);
            $table->timestamp('date_delete')->nullable()->default(null);
            $table->timestamps();

            #foreigne keys
            $table->foreign('local_id')->references('id')->on('locaux');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chambresFroides');
    }
}
