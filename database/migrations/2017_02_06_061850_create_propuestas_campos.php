<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropuestasCampos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidatos', function ($table) {
            $table->text('ambiente')->after('foto');
            $table->text('economia')->after('foto');
            $table->text('democracia')->after('foto');
            $table->text('salud')->after('foto');
            $table->text('educacion')->after('foto');
            $table->text('agricultura')->after('foto');
            $table->text('empleo')->after('foto');
            $table->text('seguridad')->after('foto');
            $table->string('binomio')->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidatos', function ($table) {
            $table->dropColumn('seguridad');
            $table->dropColumn('empleo');
            $table->dropColumn('agricultura');
            $table->dropColumn('educacion');
            $table->dropColumn('salud');
            $table->dropColumn('democracia');
            $table->dropColumn('economia');
            $table->dropColumn('ambiente');
            $table->dropColumn('binomio');
        });
    }
}
