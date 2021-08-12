<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class participantes_preguntas extends Model
{
protected $table = 'participantes_preguntas';

	public static function reportes($id){
		if($id)  {
            //foreach($objPreguntas as $pregunta){
                //echo $pregunta->pregunta.'<br>';
                $objP = DB::table('participantes_preguntas as pp')
                            ->selectRaw('count(*) as counta,pp.respuesta')
                            ->where('pp.preguntas_id','=',$id)
                            ->where('pp.estado','=','1')
                            //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                            ->groupBy('pp.preguntas_id', 'pp.respuesta')
                            ->get();
            //}
        	return $objP;
        }
		else{
			return false;
		}
	}

}
