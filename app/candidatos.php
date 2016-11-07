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
        return $this->belongsToMany('App\preguntas')->withPivot('respuesta_corta', 'respuesta_larga', 'estado');
    }

	public function scopeActivas($query){
		return $query->whereEstado(1);
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
