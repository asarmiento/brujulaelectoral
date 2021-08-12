<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class participantes extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'participantes';

	public function preguntas(){
        return $this->belongsToMany(preguntas::class,'participantes_preguntas','participantes_id','preguntas_id')->withPivot('id','respuesta');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','edad', 'genero', 'token', 'ip', 'estado'
    ];

    public static function byIp($ip = ''){
		if($ip){
			return participantes::where('ip','=',$ip)->where('estado','=','1')->first();
		}else{
			return FALSE;
		}
	}
}
