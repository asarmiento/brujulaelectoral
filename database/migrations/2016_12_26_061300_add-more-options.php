<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preguntas', function ($table) {
            $table->string('opcion_5')->after('descripcion');
            $table->string('opcion_4')->after('descripcion');
            $table->string('opcion_3')->after('descripcion');
            $table->string('opcion_2')->after('descripcion');
            $table->string('opcion_1')->after('descripcion');
        });
        Schema::table('candidatos_preguntas', function ($table) {
            $table->string('opcion')->after('respuesta_larga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('preguntas', function ($table) {
            $table->dropColumn('opcion_1');
            $table->dropColumn('opcion_2');
            $table->dropColumn('opcion_3');
            $table->dropColumn('opcion_4');
            $table->dropColumn('opcion_5');
        });
        Schema::table('candidatos_preguntas', function ($table) {
            $table->dropColumn('opcion');
        });
    }
}
