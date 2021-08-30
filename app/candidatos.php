<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidatos extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'candidatos';

	public function partidos() {
		return $this->hasOne('App\partido');
	}

	public function preguntas(){
        return $this->belongsToMany('App\preguntas')->withPivot('respuesta_corta', 'respuesta_larga', 'opcion', 'respuesta_ff', 'estado');
    }

	public static function activas(){
		return self::where('estado',1);
	}

    public function completeName()
    {
        return $this->nombre.' '.$this->apellido;
	}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'partidos_id', 'nombre', 'apellido','foto','estado'
    ];
}
