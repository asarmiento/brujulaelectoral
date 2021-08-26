<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\candidatos;
use App\participantes;
use App\preguntas;
use App\participantes_preguntas;
use App\candidatos_preguntas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $arrayResultado = array();
        $objParticipantes = null;
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->orderBy('apellido')->get();

        foreach ($objCandidato as $candidato) {
            $porcentaje = 0;
            //obtengo el objeto preguntas por candidato
            $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
            foreach ($objCandidatoPregunta as $pregunta) {
                //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                $objP = DB::table('participantes_preguntas as pp')
                    ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                    ->selectRaw('count(*) as count,pp.respuesta')
                    ->where('pp.preguntas_id', '=', $pregunta->id)
                    ->where('participantes.estado', '=', '1')
                    ->where('pp.estado', '=', '1')
                    //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                    ->groupBy('pp.preguntas_id', 'pp.respuesta')
                    ->get();
                foreach ($objP as $p) {
                    if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                        $porcentaje = $porcentaje + $p->count;
                    }
                    if ($p->respuesta == $pregunta->pivot->opcion) {
                        $porcentaje = $porcentaje + $p->count;
                    }
                }
            }
            $objParticipantes = participantes::where('estado', '=', '1')->get();
            if (count($objParticipantes)) {
                $arrayResultado[$candidato->id] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($objParticipantes));
            } else {
                $arrayResultado[$candidato->id] = 0;
            }
        }

        arsort($arrayResultado);

        $data = array(
            'objCandidato' => candidatos::activas()->orderBy('apellido')->get(),
            'objPreguntas' => preguntas::activas()->get(),
            'titulo' => 'Home',
            'arrayResultado' => $arrayResultado,
            'consulta' => array('Todas las preguntas', 'Todas las edades', 'Todos los géneros'),
        );
        return view('welcome', $data);
    }

    public function preview()
    {

        $arrayResultado = array();
        $objParticipantes = null;
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->orderBy('apellido')->get();


        foreach ($objCandidato as $candidato) {
            $porcentaje = 0;
            //obtengo el objeto preguntas por candidato
            $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
            foreach ($objCandidatoPregunta as $pregunta) {
                //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                $objParticipantes = participantes::where('estado', '=', '1')->get();
                foreach ($objParticipantes as $participante) {
                    $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id', '=', $participante->id)->orderBy('pivot_id', 'desc')->first();
                    if ($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta) {
                        $porcentaje = $porcentaje + 1;
                    }
                    //echo $porcentaje.'-';
                    if ($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion) {
                        $porcentaje = $porcentaje + 1;
                    }
                    //echo $porcentaje.'<br>';
                    //echo $objPreguntaParticipante->pivot->respuesta .'- '.$pregunta->pivot->respuesta_corta.'- '.$pregunta->pivot->opcion. '<br>';
                    //echo $candidato->nombre .' '. $porcentaje. ' R:'. $objPreguntaParticipante->pivot->respuesta . ' C:'. $pregunta->pivot->respuesta_corta. ' O:' .$objPreguntaParticipante->pivot->respuesta. '<br>';
                }

            }
            if (count($objParticipantes)) {
                $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($objParticipantes));
            } else {
                $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
            }
        }
        /*
        $objPart = participantes::where('estado','=','1')->get();
        foreach ($objPart as $opp){
            $objParticipantesPregunta = participantes_preguntas::where('participantes_id','=',$opp->id)->groupBy('preguntas_id','respuesta')->get();

            foreach ($objParticipantesPregunta as $pp) {
                $pp->estado = 1;
                $pp->save();
            }
        }*/

        arsort($arrayResultado);

        $data = array(
            'objCandidato' => candidatos::activas()->orderBy('apellido')->get(),
            'objPreguntas' => preguntas::activas()->get(),
            'titulo' => 'Home',
            'arrayResultado' => $arrayResultado,
            'consulta' => array('Todas las preguntas', 'Todas las edades', 'Todos los géneros'),
        );
        return view('welcome', $data);
    }

    public function report(Request $request)
    {
        $rPregunta = $request->rPregunta;
        $rEdad = $request->rEdad;
        $rGenero = $request->rGenero;
        $arrayResultado = array();
        $preguntaP = preguntas::whereId($rPregunta)->first();
        $participantesCriterio = participantes::where('estado', '=', '1')->get();
        $objParticipantes = null;
        $consulta = array();

        if ($rPregunta != "" and $rEdad != "" and $rGenero != "") {
            $consulta = [$preguntaP->pregunta, $rEdad, $rGenero];
            $participantesCriterio = participantes::where('estado', '=', '1')->where('edad', '=', $rEdad)->where('genero', '=', $rGenero)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            foreach ($objCandidato as $candidato) {
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach ($objCandidatoPregunta as $pregunta) {
                    if ($pregunta->id == $preguntaP->id) {
                        //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                        $objP = DB::table('participantes_preguntas as pp')
                            ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                            ->selectRaw('count(*) as count,pp.respuesta')
                            ->where('pp.preguntas_id', '=', $preguntaP->id)
                            ->where('participantes.estado', '=', '1')
                            ->where('participantes.genero', '=', $rGenero)
                            ->where('participantes.edad', '=', $rEdad)
                            ->where('pp.estado', '=', '1')
                            //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                            ->groupBy('pp.preguntas_id', 'pp.respuesta')
                            ->get();
                        foreach ($objP as $p) {
                            if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                                $porcentaje = $porcentaje + $p->count;
                            }
                            if ($p->respuesta == $pregunta->pivot->opcion) {
                                $porcentaje = $porcentaje + $p->count;
                            }
                        }
                    }
                }

                if (count($participantesCriterio)) {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($participantesCriterio));
                } else {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
                }


            }
            /* --- FIN FUNCTION ---- */
        } elseif ($rPregunta != "" and $rEdad != "" and $rGenero == "") {
            $consulta = [$preguntaP->pregunta, $rEdad, 'Todos los géneros'];
            $participantesCriterio = participantes::where('estado', '=', '1')->where('edad', '=', $rEdad)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            foreach ($objCandidato as $candidato) {
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach ($objCandidatoPregunta as $pregunta) {
                    if ($pregunta->id == $preguntaP->id) {
                        //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                        $objP = DB::table('participantes_preguntas as pp')
                            ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                            ->selectRaw('count(*) as count,pp.respuesta')
                            ->where('pp.preguntas_id', '=', $preguntaP->id)
                            ->where('participantes.estado', '=', '1')
                            ->where('participantes.edad', '=', $rEdad)
                            ->where('pp.estado', '=', '1')
                            //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                            ->groupBy('pp.preguntas_id', 'pp.respuesta')
                            ->get();
                        foreach ($objP as $p) {
                            if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                                $porcentaje = $porcentaje + $p->count;
                            }
                            if ($p->respuesta == $pregunta->pivot->opcion) {
                                $porcentaje = $porcentaje + $p->count;
                            }
                        }
                    }
                }
                if (count($participantesCriterio)) {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($participantesCriterio));
                } else {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
                }
            }
            /* --- FIN FUNCTION ---- */
        } elseif ($rPregunta != "" and $rEdad == "" and $rGenero != "") {
            $consulta = [$preguntaP->pregunta, 'Todas las edades', $rGenero];
            $participantesCriterio = participantes::where('estado', '=', '1')->where('genero', '=', $rGenero)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            foreach ($objCandidato as $candidato) {
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach ($objCandidatoPregunta as $pregunta) {
                    if ($pregunta->id == $preguntaP->id) {
                        //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                        $objP = DB::table('participantes_preguntas as pp')
                            ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                            ->selectRaw('count(*) as count,pp.respuesta')
                            ->where('pp.preguntas_id', '=', $preguntaP->id)
                            ->where('participantes.estado', '=', '1')
                            ->where('participantes.genero', '=', $rGenero)
                            ->where('pp.estado', '=', '1')
                            //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                            ->groupBy('pp.preguntas_id', 'pp.respuesta')
                            ->get();
                        foreach ($objP as $p) {
                            if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                                $porcentaje = $porcentaje + $p->count;
                            }
                            if ($p->respuesta == $pregunta->pivot->opcion) {
                                $porcentaje = $porcentaje + $p->count;
                            }
                        }
                    }
                }
                if (count($participantesCriterio)) {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($participantesCriterio));
                } else {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
                }
            }
            /* --- FIN FUNCTION ---- */
        } elseif ($rPregunta == "" and $rEdad != "" and $rGenero != "") {
            $consulta = ['Todas las preguntas', $rEdad, $rGenero];
            $participantesCriterio = participantes::where('estado', '=', '1')->where('edad', '=', $rEdad)->where('genero', '=', $rGenero)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            foreach ($objCandidato as $candidato) {
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach ($objCandidatoPregunta as $pregunta) {
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objP = DB::table('participantes_preguntas as pp')
                        ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                        ->selectRaw('count(*) as count,pp.respuesta')
                        ->where('pp.preguntas_id', '=', $pregunta->id)
                        ->where('participantes.estado', '=', '1')
                        ->where('participantes.genero', '=', $rGenero)
                        ->where('participantes.edad', '=', $rEdad)
                        ->where('pp.estado', '=', '1')
                        //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                        ->groupBy('pp.preguntas_id', 'pp.respuesta')
                        ->get();
                    foreach ($objP as $p) {
                        if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                            $porcentaje = $porcentaje + $p->count;
                        }
                        if ($p->respuesta == $pregunta->pivot->opcion) {
                            $porcentaje = $porcentaje + $p->count;
                        }
                    }
                }
                if (count($participantesCriterio)) {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($participantesCriterio));
                } else {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
                }
            }
            /* --- FIN FUNCTION ---- */
        } elseif ($rPregunta == "" and $rEdad == "" and $rGenero != "") {
            $consulta = ['Todas las preguntas', "Todos las edades", $rGenero];
            $participantesCriterio = participantes::where('estado', '=', '1')->where('genero', '=', $rGenero)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            foreach ($objCandidato as $candidato) {
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach ($objCandidatoPregunta as $pregunta) {
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objP = DB::table('participantes_preguntas as pp')
                        ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                        ->selectRaw('count(*) as count,pp.respuesta')
                        ->where('pp.preguntas_id', '=', $pregunta->id)
                        ->where('participantes.estado', '=', '1')
                        ->where('participantes.genero', '=', $rGenero)
                        ->where('pp.estado', '=', '1')
                        //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                        ->groupBy('pp.preguntas_id', 'pp.respuesta')
                        ->get();
                    foreach ($objP as $p) {
                        if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                            $porcentaje = $porcentaje + $p->count;
                        }
                        if ($p->respuesta == $pregunta->pivot->opcion) {
                            $porcentaje = $porcentaje + $p->count;
                        }
                    }
                }
                if (count($participantesCriterio)) {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($participantesCriterio));
                } else {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
                }
            }
            /* --- FIN FUNCTION ---- */
        } elseif ($rPregunta != "" and $rEdad == "" and $rGenero == "") {
            $consulta = [$preguntaP->pregunta, "Todos las edades", "Todos los géneros"];
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            foreach ($objCandidato as $candidato) {
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach ($objCandidatoPregunta as $pregunta) {
                    if ($pregunta->id == $preguntaP->id) {
                        //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                        $objP = DB::table('participantes_preguntas as pp')
                            ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                            ->selectRaw('count(*) as count,pp.respuesta')
                            ->where('pp.preguntas_id', '=', $preguntaP->id)
                            ->where('participantes.estado', '=', '1')
                            ->where('pp.estado', '=', '1')
                            //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                            ->groupBy('pp.preguntas_id', 'pp.respuesta')
                            ->get();
                        foreach ($objP as $p) {
                            if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                                $porcentaje = $porcentaje + $p->count;
                            }
                            if ($p->respuesta == $pregunta->pivot->opcion) {
                                $porcentaje = $porcentaje + $p->count;
                            }
                        }
                    }
                }
                $objParticipantes = participantes::where('estado', '=', '1')->get();
                if (count($objParticipantes)) {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($objParticipantes));
                } else {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
                }

            }
            /* --- FIN FUNCTION ---- */
        } elseif ($rPregunta == "" and $rEdad != "" and $rGenero == "") {
            $consulta = ["Todas las preguntas", $rEdad, "Todos los géneros"];
            $participantesCriterio = participantes::where('estado', '=', '1')->where('edad', '=', $rEdad)->get();
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            foreach ($objCandidato as $candidato) {
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach ($objCandidatoPregunta as $pregunta) {
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objP = DB::table('participantes_preguntas as pp')
                        ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                        ->selectRaw('count(*) as count,pp.respuesta')
                        ->where('pp.preguntas_id', '=', $pregunta->id)
                        ->where('participantes.estado', '=', '1')
                        ->where('participantes.edad', '=', $rEdad)
                        ->where('pp.estado', '=', '1')
                        //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                        ->groupBy('pp.preguntas_id', 'pp.respuesta')
                        ->get();
                    foreach ($objP as $p) {
                        if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                            $porcentaje = $porcentaje + $p->count;
                        }
                        if ($p->respuesta == $pregunta->pivot->opcion) {
                            $porcentaje = $porcentaje + $p->count;
                        }
                    }
                }
                if (count($participantesCriterio)) {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($participantesCriterio));
                } else {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
                }
            }
            /* --- FIN FUNCTION ---- */
        } else {
            $consulta = ['Todas las preguntas', 'Todas las edades', 'Todos los géneros'];
            //Obtengo el objeto de los candidatos
            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            foreach ($objCandidato as $candidato) {
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach ($objCandidatoPregunta as $pregunta) {
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objP = DB::table('participantes_preguntas as pp')
                        ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                        ->selectRaw('count(*) as count,pp.respuesta')
                        ->where('pp.preguntas_id', '=', $pregunta->id)
                        ->where('participantes.estado', '=', '1')
                        ->where('pp.estado', '=', '1')
                        //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                        ->groupBy('pp.preguntas_id', 'pp.respuesta')
                        ->get();
                    foreach ($objP as $p) {
                        if ($p->respuesta == $pregunta->pivot->respuesta_corta) {
                            $porcentaje = $porcentaje + $p->count;
                        }
                        if ($p->respuesta == $pregunta->pivot->opcion) {
                            $porcentaje = $porcentaje + $p->count;
                        }
                    }
                }
                $objParticipantes = participantes::where('estado', '=', '1')->get();
                if (count($objParticipantes)) {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / (count([$objCandidatoPregunta]) * count($objParticipantes));
                } else {
                    $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = 0;
                }

            }
            /* --- FIN FUNCTION ---- */
        }


        arsort($arrayResultado);

        $data = array(
            'objCandidato' => candidatos::activas()->orderBy('apellido')->get(),
            'objPreguntas' => preguntas::activas()->get(),
            'consulta' => $consulta,
            'arrayResultado' => $arrayResultado,
            'titulo' => 'Home',
        );
        return view('frontend.compare', $data);
    }


    public function create()
    {
        $data = array(
            'objCandidato' => candidatos::activas()->orderBy('apellido')->get(),
            'titulo' => 'Home',
        );
        return view('frontend.loginJuego', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'edad' => 'required',
            'genero' => 'required',
        ]);

        $objParticipantes = new participantes();
        $objParticipantes->nombre = $request->nombre;
        $objParticipantes->edad = $request->edad;
        $objParticipantes->genero = $request->genero;
        $objParticipantes->ip = $request->ip();

        $data = array(
            'objCandidato' => candidatos::activas()->orderBy('apellido')->get(),
            'objPreguntas' => preguntas::activas()->get(),
            'titulo' => 'Home',
        );

        //validacion por IP para multiples participaciones
        //if(!$objParticipantes->byIp($objParticipantes->ip)){


        if ($objParticipantes->save()) {

            session(['participante' => $objParticipantes->id]);

            return redirect('juego')->with('msj', 'Datos Guardados');


        } else {
            return back()->with('error_msj', 'Datos no guardados');
        };

        /*}else{
            //Cuando el usuario tiene la misma IP
            return back()->with('error_msj','Usted ya participó');
        }*/

    }

    public function viewJuego()
    {

        if (session('participante')) {
            $objPregunta = participantes::find(session('participante'))->preguntas()->orderBy('pivot_id', 'desc')->first();

            if ($objPregunta) {

                $objPreguntaAct = preguntas::activas()->where('id', '>', $objPregunta->id)->first();
                if ($objPreguntaAct) {

                    $objCandidato = candidatos::activas()->orderBy('apellido')->get();
                    $objPreguntas = preguntas::activas()->get();
                    //'objPreguntasUsuario' => participantes::find(session('participante'))->preguntas()->get(),
                    $titulo = 'Juego Brújula Electoral';
                } else {
                    $objParticipante = participantes::find(session('participante'));

                    if ($objParticipante) {
                        //Activo el participante despues que haya contestado todas las preguntas
                        $objParticipante->estado = 1;
                        $objParticipante->save();

                        $objParticipantesPregunta = participantes_preguntas::where('participantes_id', '=', $objParticipante->id)->groupBy('preguntas_id', 'respuesta')->get();

                        foreach ($objParticipantesPregunta as $pp) {
                            $pp->estado = 1;
                            $pp->save();
                        }


                        return redirect('juego-resultado');
                    } else {
                        return redirect('juego-login');
                    }
                }
            } else {

                    $objCandidato = candidatos::activas()->orderBy('apellido')->get();
                    $objPreguntaAct = preguntas::activas()->first();
                    $objPreguntas = preguntas::activas()->get();
                    //'objPreguntasUsuario' => participantes::find(session('participante'))->preguntas()->get(),
                    $titulo = 'Juego Brújula Electoral';


            }


            return view('frontend.juego', compact('objCandidato','objPreguntaAct','objPreguntas','titulo'));

        } else {
            return redirect('juego-login');
        }

    }

    public function storeJuego(Request $request)
    {
        $this->validate($request, [
            'respuesta' => 'required',
        ]);

        if (session('participante')) {
            $objParticipacion = new participantes_preguntas();
            $objParticipacion->respuesta = $request->respuesta;
            $objParticipacion->preguntas_id = $request->pregunta;
            $objParticipacion->participantes_id = session('participante');

            if ($objParticipacion->save()) {

                if ($objParticipacion->respuesta == 'A favor' || substr($objParticipacion->respuesta, 0, 3) == 'A favor') {
                    $objRespuestas = preguntas::find($objParticipacion->preguntas_id)->candidatos()->orderBy('respuesta_corta', 'DESC')->get();
                }else if ($objParticipacion->respuesta == 'Neutro' || substr($objParticipacion->respuesta, 0, 3) == 'Neutro') {
                    $objRespuestas = preguntas::find($objParticipacion->preguntas_id)->candidatos()->orderBy('respuesta_corta', 'DESC')->get();
                } else {
                    $objRespuestas = preguntas::find($objParticipacion->preguntas_id)->candidatos()->orderBy('respuesta_corta')->get();
                }


                $data = array(
                    'objCandidato' => candidatos::activas()->orderBy('apellido')->get(),
                    'objPregunta' => preguntas::whereId($objParticipacion->preguntas_id)->first(),
                    'objRespuestas' => $objRespuestas,
                    'objPreguntasTodas' => preguntas::activas()->get(),
                    'objMiRespuesta' => participantes::find($objParticipacion->participantes_id)->preguntas()->orderBy('pivot_id', 'desc')->first(),
                    'titulo' => 'Juego Brújula Electoral',
                );

                return view('frontend.juegoRespuesta', $data);

            } else {
                return back()->with('error_msj', 'Datos no guardados');
            }

        } else {
            return redirect('juego-login');
        }

    }

    public function resultado()
    {
        if (session('participante')) {


            $objCandidato = candidatos::activas()->orderBy('apellido')->get();
            $arrayResultado = array();
            foreach ($objCandidato as $candidato) {
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();


                $porcentaje = 0;
                foreach ($objCandidatoPregunta as $pregunta) {

                    $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id', '=', session('participante'))->orderBy('pivot_id', 'desc')->first();

                    if ($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta) {
                        $porcentaje = $porcentaje + 1;
                    }
                    if ($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->opcion) {
                        $porcentaje = $porcentaje + 1;
                    }

                }

                $arrayResultado[$candidato->nombre . ' ' . $candidato->apellido] = $porcentaje * 100 / count([$objCandidatoPregunta]);

            }

            $objParticipantes = participantes::find(session('participante'))->preguntas()->get();

            arsort($arrayResultado);

            $data = array(
                'objCandidato' => candidatos::activas()->get(),
                'objCandidatoPregunta' => candidatos_preguntas::get(),
                'arrayResultado' => $arrayResultado,
                'titulo' => 'Home',
            );
            return view('frontend.juegoResultado', $data);
        } else {
            return redirect('juego-login');
        }
    }


    public function frenteafrente()
    {
        $data = array(
            'objCandidato' => candidatos::activas()->orderBy('apellido')->get(),
            'objPreguntas' => preguntas::activas()->get(),
            'objCandidato1' => "",
            'objCandidato2' => "",
            'titulo' => 'Frente a Frente',
        );
        return view('frontend.afrente', $data);
    }

    public function showfrenteafrente(Request $request)
    {

        $candidato1 = $request->frente_1;
        $candidato2 = $request->frente_2;


        $data = array(
            'objCandidato' => candidatos::activas()->orderBy('apellido')->get(),
            //'objPreguntas' => preguntas::whereIn('id',[1,2])->activas()->get(),
            'objPreguntas' => preguntas::activas()->get(),
            'objCandidato1' => candidatos::whereId($candidato1)->first(),
            'objCandidato2' => candidatos::whereId($candidato2)->first(),
            'titulo' => 'Frente a Frente',
        );
        return view('frontend.afrente', $data);
    }

    public function nosotros()
    {

        $data = array(
            'titulo' => 'Brújula Electoral',
        );
        return view('frontend.nosotros', $data);
    }

}
