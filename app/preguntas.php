<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class preguntas extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'preguntas';

    public function participantes(){
        return $this->belongsToMany('App\participantes')->withPivot('id','respuesta');
    }

    public function candidatos(){
        return $this->belongsToMany('App\candidatos')->withPivot('respuesta_corta', 'respuesta_larga', 'opcion', 'respuesta_ff', 'estado');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pregunta', 'estado'
    ];

    public function scopeActivas($query){
        return $query->whereEstado(1);
    }
    
}
