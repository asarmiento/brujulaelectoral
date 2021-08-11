<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class respuestas extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'respuestas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidatos_id', 'preguntas_id', 'respuesta_corta', 'respuesta_larga', 'estado'
    ];
}
