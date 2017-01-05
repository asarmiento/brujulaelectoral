<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoParticipantesPreguntas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('participantes_preguntas', function ($table) {
            $table->string('estado')->default(0)->after('respuesta');
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
        Schema::table('participantes_preguntas', function ($table) {
            $table->dropColumn('estado');
        });
    }
}
