<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerte_gouvs', function (Blueprint $table) {
            $table->bigIncrements('idAlerteGouv');
            $table->integer('Annee');
            $table->integer('Mois');
            $table->integer('NombreCrime');
            $table->integer('LibeleeAlerte');

            $table->string('RefDepartement');
            $table->foreign('RefDepartement')->references('idDepartement')->on('departements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerte_gouvs');
    }
};
