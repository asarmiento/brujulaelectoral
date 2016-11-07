<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partidos_id')->unsigned();
            $table->foreign('partidos_id')->references('id')->on('partidos')->onDelete('restrict')->onUpdate('restrict');
            $table->string('nombre',200)->nullable();
            $table->string('apellido',200)->nullable();
            $table->string('foto')->nullable();
            $table->boolean('estado')->default(1);
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
        Schema::drop('candidatos');
    }
}
