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
            $table->string('opcion_si_1')->after('descripcion');
            $table->string('opcion_si_2')->after('descripcion');
            $table->string('opcion_no_1')->after('descripcion');
            $table->string('opcion_no_2')->after('descripcion');
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
            $table->dropColumn('opcion_si_1');
            $table->dropColumn('opcion_si_2');
            $table->dropColumn('opcion_no_1');
            $table->dropColumn('opcion_no_2');
        });
    }
}
