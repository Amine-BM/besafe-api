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
        Schema::create('alertvvs', function (Blueprint $table) {
            $table->bigIncrements('idAlerteVV');
            $table->timestamps();
            $table->integer('nivDanger');

            $table->unsignedBigInteger('RefUser');
            $table->foreign('RefUser')->references('id')->on('users');

            $table->unsignedBigInteger('RefPosition');
            $table->foreign('RefPosition')->references('idPosition')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alertvvs');
    }
};
