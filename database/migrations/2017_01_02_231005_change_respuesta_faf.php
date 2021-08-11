<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRespuestaFaf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('candidatos_preguntas', function ($table) {
            $table->string('respuesta_ff', 1500)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('candidatos_preguntas', function ($table) {
            $table->string('respuesta_ff', 255)->change();
        });
    }
}
