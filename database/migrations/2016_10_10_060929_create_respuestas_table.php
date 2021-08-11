<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidatos_id')->unsigned();
            $table->integer('preguntas_id')->unsigned();
            $table->foreign('candidatos_id')->references('id')->on('candidatos')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('preguntas_id')->references('id')->on('preguntas')->onDelete('restrict')->onUpdate('restrict');
            $table->string('respuesta_corta',6)->nullable();
            $table->text('respuesta_larga')->nullable();
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
        Schema::drop('respuestas');
    }
}
