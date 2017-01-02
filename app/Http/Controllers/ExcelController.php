<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Maatwebsite\Excel\Facades\Excel;
use App\candidatos;
use App\participantes;
use App\preguntas;
use App\participantes_preguntas;
use App\candidatos_preguntas;

class ExcelController extends Controller
{
    public function index(Request $request)    
	{
		$rPregunta = $request->rPregunta;
        $rEdad = $request->rEdad;
        $rGenero = $request->rGenero;
        $tipoDownload = $request->tipoDownload;
        $preguntaP = preguntas::whereId($rPregunta)->first();
        $participantesCriterio = participantes::where('estado','=','1')->get();

        $arrayResultado = array();

        

    	if($rPregunta != "" and $rEdad != "" and $rGenero != ""){
            $consulta = [$preguntaP->pregunta,$rEdad,$rGenero];
            $participantesCriterio = participantes::where('estado','=','1')->where('edad','=',$rEdad)->where('genero','=',$rGenero)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->get();
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($pregunta->id == $preguntaP->id and $participante->genero == $rGenero and $participante->edad == $rEdad){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + 1;
                            }
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + 1;
                            }
                        }
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
					'porcentaje' => $porcentaje*100/(count($objCandidatoPregunta)*count($participantesCriterio)),
					);
            }
            /* --- FIN FUNCTION ---- */
        }elseif($rPregunta != "" and $rEdad != "" and $rGenero == ""){
            $consulta = [$preguntaP->pregunta,$rEdad,'Todos los géneros'];
            $participantesCriterio = participantes::where('estado','=','1')->where('edad','=',$rEdad)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->get();
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($pregunta->id == $preguntaP->id and $participante->edad == $rEdad){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + 1;
                            }
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + 1;
                            }
                        }
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
					'porcentaje' => $porcentaje*100/(count($objCandidatoPregunta)*count($participantesCriterio)),
					);
            }
            /* --- FIN FUNCTION ---- */
        }elseif($rPregunta != "" and $rEdad == "" and $rGenero != ""){
            $consulta = [$preguntaP->pregunta,'Todas las edades',$rGenero];
            $participantesCriterio = participantes::where('estado','=','1')->where('genero','=',$rGenero)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->get();
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($pregunta->id == $preguntaP->id and $participante->genero == $rGenero){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + 1;
                            }
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + 1;
                            }
                        }
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
					'porcentaje' => $porcentaje*100/(count($objCandidatoPregunta)*count($participantesCriterio)),
					);
            }
            /* --- FIN FUNCTION ---- */
        }elseif($rPregunta == "" and $rEdad != "" and $rGenero != ""){
            $consulta = ['Todas las preguntas',$rEdad,$rGenero];
            $participantesCriterio = participantes::where('estado','=','1')->where('edad','=',$rEdad)->where('genero','=',$rGenero)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->get();
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->edad == $rEdad and $participante->genero == $rGenero){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + 1;
                            }
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + 1;
                            }
                        }
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
					'porcentaje' => $porcentaje*100/(count($objCandidatoPregunta)*count($participantesCriterio)),
					);
            }
            /* --- FIN FUNCTION ---- */
        }elseif($rPregunta == "" and $rEdad == "" and $rGenero != ""){
            $consulta = ['Todas las preguntas',"Todos las edades",$rGenero];
            $participantesCriterio = participantes::where('estado','=','1')->where('genero','=',$rGenero)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->get();
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->genero == $rGenero){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + 1;
                            }
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + 1;
                            }
                        }
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
					'porcentaje' => $porcentaje*100/(count($objCandidatoPregunta)*count($participantesCriterio)),
					);
            }
            /* --- FIN FUNCTION ---- */
        }elseif($rPregunta != "" and $rEdad == "" and $rGenero == ""){
            $consulta = [$preguntaP->pregunta,"Todos las edades","Todos los géneros"];
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->get();
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($pregunta->id == $preguntaP->id){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + 1;
                            }
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + 1;
                            }
                        }
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
					'porcentaje' => $porcentaje*100/(count($objCandidatoPregunta)*count($objParticipantes)),
					);
            }
            /* --- FIN FUNCTION ---- */
        }elseif($rPregunta == "" and $rEdad != "" and $rGenero == ""){
            $consulta = ["Todas las preguntas",$rEdad,"Todos los géneros"];
            $participantesCriterio = participantes::where('estado','=','1')->where('edad','=',$rEdad)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->get();
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->edad == $rEdad){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + 1;
                            }
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + 1;
                            }
                        }
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
					'porcentaje' => $porcentaje*100/(count($objCandidatoPregunta)*count($participantesCriterio)),
					);
            }
            /* --- FIN FUNCTION ---- */
        }else{
            $consulta = ['Todas las preguntas','Todas las edades','Todos los géneros'];
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->get();
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + 1;
                            }
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + 1;
                            }
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
					'porcentaje' => number_format($porcentaje*100/(count($objCandidatoPregunta)*count($objParticipantes))),
					);
            }
            /* --- FIN FUNCTION ---- */
        }

        foreach ($arrayResultado as $clave => $fila) {
		    $candidato[$clave] = $fila['candidatos'];
		    $porcentaje1[$clave] = number_format($fila['porcentaje']);
		}

		array_multisort($porcentaje1, SORT_DESC, $arrayResultado);
		
		$participantesCriterio = count($participantesCriterio);
		$totalParticipantes = count($objParticipantes);

		if($tipoDownload=='excel'){
			//ARMADO DEL EXCEL CON LOS DATOS DEL ARRAY	
			Excel::create('Brújula Electoral Excel', function($excel) use($arrayResultado,$consulta,$participantesCriterio,$totalParticipantes){
	 		
	            $excel->sheet('Participantes', function($sheet) use($arrayResultado,$consulta,$participantesCriterio,$totalParticipantes) {
	            	
	            	
	                $sheet->with($arrayResultado);
	                
	                $sheet->prependRow(array(
                           'Participantes por criterio de búsqueda',$participantesCriterio
                        ));
                    $sheet->prependRow(array(
                            'Total de participantes en el sitio', $totalParticipantes
                        ));
	                $sheet->prependRow(array(
						    $consulta[0]
						));
                    $sheet->prependRow(array(
                            'PREGUNTA'
                        ));
                    $sheet->prependRow(array(
                            $consulta[1]
                        ));
                    $sheet->prependRow(array(
                            'EDAD'
                        ));
                    $sheet->prependRow(array(
                            $consulta[2]
                        ));
                    $sheet->prependRow(array(
                            'GÉNERO'
                        ));
	                $sheet->prependRow(array(
						    'FILTROS DE BÚSQUEDA:'
						));
	                $sheet->prependRow(array(
						    'BRÚJULA ELECTORAL'
						));
	                $sheet->cell('A11', function($cell) {
					    $cell->setValue('Candidatos');
					    $cell->setBackground('#74c2ab');
					    $cell->setFontSize(14);
                        $cell->setFontWeight('bold');
					});
                    $sheet->cell('B11', function($cell) {
                        $cell->setValue('Porcentajes');
                        $cell->setBackground('#74c2ab');
                        $cell->setFontSize(14);
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('A2', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('A3', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('A5', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('A7', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('C10', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('A9', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('A10', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('B8', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('C8', function($cell) {
                        $cell->setFontWeight('bold');
                    });
					$sheet->cell('A1', function($cell) {
					    $cell->setBackground('#fee100');
					    $cell->setFontSize(16);
					    $cell->setFontWeight('bold');
					});
	 
	            });
	        })->export('xls');
	    }else{
	    	//ARMADO DEL EXCEL CON LOS DATOS DEL ARRAY	
			Excel::create('Brújula Electoral Excel', function($excel) use($arrayResultado,$consulta,$participantesCriterio,$totalParticipantes){
	 		
	            $excel->sheet('Participantes', function($sheet) use($arrayResultado,$consulta,$participantesCriterio,$totalParticipantes) {
	            	
	            	
	                $sheet->with($arrayResultado);
	                
	                $sheet->prependRow(array(
						    'Participantes por criterio de búsqueda',$participantesCriterio,'Total de participantes en el sitio', $totalParticipantes
						));
	                $sheet->prependRow(array(
						    $consulta[0], $consulta[1],$consulta[2]
						));
	                $sheet->prependRow(array(
						    'PREGUNTA','EDAD','GÉNERO'
						));
	                $sheet->prependRow(array(
						    'FILTROS DE BÚSQUEDA:'
						));
	                $sheet->prependRow(array(
						    'BRÚJULA ELECTORAL'
						));
                    $sheet->cell('A2', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('A3', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('A5', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('C5', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('B3', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $sheet->cell('C3', function($cell) {
                        $cell->setFontWeight('bold');
                    });
	                $sheet->cell('A6', function($cell) {
					    $cell->setValue('Candidatos');
					    $cell->setBackground('#74c2ab');
					    $cell->setFontSize(14);
					});
					$sheet->cell('B6', function($cell) {
					    $cell->setValue('Porcentajes');
					    $cell->setBackground('#74c2ab');
					    $cell->setFontSize(14);
					});
					$sheet->cell('A1', function($cell) {
					    $cell->setBackground('#fee100');
					    $cell->setFontSize(16);
					    $cell->setFontWeight('bold');
					});
	 
	            });
	        })->export('csv');
	    }
 
	}

	
}
