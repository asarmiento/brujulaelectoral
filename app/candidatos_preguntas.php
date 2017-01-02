<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidatos_preguntas extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'candidatos_preguntas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidatos_id', 'preguntas_id', 'respuesta_corta', 'respuesta_larga', 'opcion', 'respuesta_ff', 'estado'
    ];
}
