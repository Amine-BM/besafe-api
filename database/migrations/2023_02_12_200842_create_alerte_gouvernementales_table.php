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
        Schema::create('alerte_gouvernementales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->string('type_alerte');

            $table->unsignedBigInteger('id_ville');
            $table->foreign('id_ville')->references('id')->on('villes');

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
        Schema::dropIfExists('alerte_gouvernementales');
    }
};
