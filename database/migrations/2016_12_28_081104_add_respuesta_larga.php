<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRespuestaLarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidatos_preguntas', function ($table) {
            $table->string('respuesta_ff')->after('opcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidatos_preguntas', function ($table) {
            $table->dropColumn('respuesta_ff');
        });
    }
}
