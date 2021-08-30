<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\candidatos;
use App\preguntas;
use App\participantes;
use Illuminate\Support\Facades\DB;


class BackendHomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->reporte();
        $data = array(
                    'objCandidatos' => candidatos::activas()->get(),
                    'objPreguntas' => preguntas::activas()->get(),
                    'objParticipantes' => participantes::where('estado','=','1')->get(),
                    'objNoParticipantes' => participantes::where('estado','=','0')->get(),
                    'arrayResultado' => $this->showTodos(),
                    'arrayFemenino' => $this->showFemenino(),
                    'arrayMasculino' => $this->showMasculino(),
                    'arrayGLTB' => $this->showGLTB(),
                    'array1625' => $this->show1625(),
                    'array2535' => $this->show2535(),
                    'array3545' => $this->show3545(),
                    'array45' => $this->show45(),
                    'titulo' => 'Home',
                );

        return view('home',$data);
    }

    public function showTodos()
    {
        //Obtengo el objeto de los candidatos
        $objParticipantes = null;
        $objCandidato = candidatos::activas()->get();
        if(count([$objCandidato]))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas

                    $objP = DB::table('participantes_preguntas as pp')
                                ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                                ->selectRaw('count(*) as count,pp.respuesta')
                                ->where('pp.preguntas_id','=',$pregunta->id)
                                ->where('participantes.estado','=','1')
                                ->where('pp.estado','=','1')
                                //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                                ->groupBy('pp.preguntas_id', 'pp.respuesta')
                                ->get();
                    foreach($objP as $p){
                        if($p->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + $p->count;
                            }
                        if($p->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + $p->count;
                            }
                     }
                }
                $objParticipantes = participantes::where('estado','=','1')->get();
                if(count($objParticipantes)){
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => $porcentaje/(count([$objCandidatoPregunta])*count($objParticipantes)),
                    );
                }else{
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => 0,
                    );
                }

            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {

                $candidatoId[$clave] = $fila['candidatosId'];
                $candidato[$clave] = $fila['candidatos'];
                $porcentaje1[$clave] = $fila['porcentaje'];
            }

            array_multisort($porcentaje1, SORT_DESC, $arrayResultado);

            $arrayResultado = array_slice($arrayResultado, 0, 5);

            return $arrayResultado;
        }else{
            return false;
        }

    }

    public function showFemenino()
    {
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->get();
        $objParticipantes = null;

        if(count([$objCandidato]))  {

            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas

                    $objP = DB::table('participantes_preguntas as pp')
                                ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                                ->selectRaw('count(*) as count,pp.respuesta')
                                ->where('pp.preguntas_id','=',$pregunta->id)
                                ->where('participantes.estado','=','1')
                                ->where('participantes.genero','=','Femenino')
                                ->where('pp.estado','=','1')
                                //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                                ->groupBy('pp.preguntas_id', 'pp.respuesta')
                                ->get();
                    foreach($objP as $p){
                        if($p->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + $p->count;
                            }
                        if($p->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + $p->count;
                            }
                     }
                }
                $objParticipantes = participantes::where('estado','=','1')->get();
                if(count($objParticipantes)){
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => $porcentaje/(count([$objCandidatoPregunta])*count($objParticipantes)),
                    );
                }else{
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => 0,
                    );
                }
            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {
                $candidatoId[$clave] = $fila['candidatosId'];
                $candidato[$clave] = $fila['candidatos'];
                $porcentaje1[$clave] = $fila['porcentaje'];
            }

            array_multisort($porcentaje1, SORT_DESC, $arrayResultado);

            $arrayResultado = array_slice($arrayResultado, 0, 5);

            return $arrayResultado;
        }else{
            return false;
        }
    }

    public function showMasculino()
    {
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->get();
        $objParticipantes = null;

        if(count([$objCandidato]))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas

                    $objP = DB::table('participantes_preguntas as pp')
                                ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                                ->selectRaw('count(*) as count,pp.respuesta')
                                ->where('pp.preguntas_id','=',$pregunta->id)
                                ->where('participantes.estado','=','1')
                                ->where('participantes.genero','=','Masculino')
                                ->where('pp.estado','=','1')
                                //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                                ->groupBy('pp.preguntas_id', 'pp.respuesta')
                                ->get();
                    foreach($objP as $p){
                        if($p->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + $p->count;
                            }
                        if($p->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + $p->count;
                            }
                     }
                }
                $objParticipantes = participantes::where('estado','=','1')->get();
                if(count($objParticipantes)){
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => $porcentaje/(count([$objCandidatoPregunta])*count($objParticipantes)),
                    );
                }else{
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => 0,
                    );
                }
            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {
                $candidatoId[$clave] = $fila['candidatosId'];
                $candidato[$clave] = $fila['candidatos'];
                $porcentaje1[$clave] = $fila['porcentaje'];
            }

            array_multisort($porcentaje1, SORT_DESC, $arrayResultado);

            $arrayResultado = array_slice($arrayResultado, 0, 5);

            return $arrayResultado;
        }else{
            return false;
        }
    }

    public function showGLTB()
    {
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->get();
        $objParticipantes = null;

        if(count([$objCandidato]))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas

                    $objP = DB::table('participantes_preguntas as pp')
                                ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                                ->selectRaw('count(*) as count,pp.respuesta')
                                ->where('pp.preguntas_id','=',$pregunta->id)
                                ->where('participantes.estado','=','1')
                                ->where('participantes.genero','=','GLTB')
                                ->where('pp.estado','=','1')
                                //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                                ->groupBy('pp.preguntas_id', 'pp.respuesta')
                                ->get();
                    foreach($objP as $p){
                        if($p->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + $p->count;
                            }
                        if($p->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + $p->count;
                            }
                     }
                }
                $objParticipantes = participantes::where('estado','=','1')->get();
                if(count($objParticipantes)){
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => $porcentaje/(count([$objCandidatoPregunta])*count($objParticipantes)),
                    );
                }else{
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => 0,
                    );
                }
            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {
                $candidatoId[$clave] = $fila['candidatosId'];
                $candidato[$clave] = $fila['candidatos'];
                $porcentaje1[$clave] = $fila['porcentaje'];
            }

            array_multisort($porcentaje1, SORT_DESC, $arrayResultado);

            $arrayResultado = array_slice($arrayResultado, 0, 5);

            return $arrayResultado;
        }else{
            return false;
        }
    }

    public function show1625()
    {
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->get();
        $objParticipantes = null;

        if(count([$objCandidato]))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas

                    $objP = DB::table('participantes_preguntas as pp')
                                ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                                ->selectRaw('count(*) as count,pp.respuesta')
                                ->where('pp.preguntas_id','=',$pregunta->id)
                                ->where('participantes.estado','=','1')
                                ->where('participantes.edad','=','16 - 25')
                                ->where('pp.estado','=','1')
                                //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                                ->groupBy('pp.preguntas_id', 'pp.respuesta')
                                ->get();
                    foreach($objP as $p){
                        if($p->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + $p->count;
                            }
                        if($p->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + $p->count;
                            }
                     }
                }
                $objParticipantes = participantes::where('estado','=','1')->get();
                if(count($objParticipantes)){
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => $porcentaje/(count([$objCandidatoPregunta])*count($objParticipantes)),
                    );
                }else{
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => 0,
                    );
                }
            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {
                $candidatoId[$clave] = $fila['candidatosId'];
                $candidato[$clave] = $fila['candidatos'];
                $porcentaje1[$clave] = $fila['porcentaje'];
            }

            array_multisort($porcentaje1, SORT_DESC, $arrayResultado);

            $arrayResultado = array_slice($arrayResultado, 0, 5);

            return $arrayResultado;
        }else{
            return false;
        }
    }

    public function show2535()
    {
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->get();
        $objParticipantes = null;

        if(count([$objCandidato]))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas

                    $objP = DB::table('participantes_preguntas as pp')
                                ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                                ->selectRaw('count(*) as count,pp.respuesta')
                                ->where('pp.preguntas_id','=',$pregunta->id)
                                ->where('participantes.estado','=','1')
                                ->where('participantes.edad','=','25 - 35')
                                ->where('pp.estado','=','1')
                                //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                                ->groupBy('pp.preguntas_id', 'pp.respuesta')
                                ->get();
                    foreach($objP as $p){
                        if($p->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + $p->count;
                            }
                        if($p->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + $p->count;
                            }
                     }
                }
                $objParticipantes = participantes::where('estado','=','1')->get();
                if(count($objParticipantes)){
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => $porcentaje/(count([$objCandidatoPregunta])*count($objParticipantes)),
                    );
                }else{
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => 0,
                    );
                }
            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {
                $candidatoId[$clave] = $fila['candidatosId'];
                $candidato[$clave] = $fila['candidatos'];
                $porcentaje1[$clave] = $fila['porcentaje'];
            }

            array_multisort($porcentaje1, SORT_DESC, $arrayResultado);

            $arrayResultado = array_slice($arrayResultado, 0, 5);

            return $arrayResultado;
        }else{
            return false;
        }
    }

    public function show3545()
    {
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->get();
        $objParticipantes = null;

        if(count([$objCandidato]))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas

                    $objP = DB::table('participantes_preguntas as pp')
                                ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                                ->selectRaw('count(*) as count,pp.respuesta')
                                ->where('pp.preguntas_id','=',$pregunta->id)
                                ->where('participantes.estado','=','1')
                                ->where('participantes.edad','=','35 - 45')
                                ->where('pp.estado','=','1')
                                //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                                ->groupBy('pp.preguntas_id', 'pp.respuesta')
                                ->get();
                    foreach($objP as $p){
                        if($p->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + $p->count;
                            }
                        if($p->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + $p->count;
                            }
                     }
                }
                $objParticipantes = participantes::where('estado','=','1')->get();
                if(count($objParticipantes)){
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => $porcentaje/(count([$objCandidatoPregunta])*count($objParticipantes)),
                    );
                }else{
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => 0,
                    );
                }
            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {
                $candidatoId[$clave] = $fila['candidatosId'];
                $candidato[$clave] = $fila['candidatos'];
                $porcentaje1[$clave] = $fila['porcentaje'];
            }

            array_multisort($porcentaje1, SORT_DESC, $arrayResultado);

            $arrayResultado = array_slice($arrayResultado, 0, 5);

            return $arrayResultado;
        }else{
            return false;
        }
    }

    public function reporte()
    {
        $objPreguntas = preguntas::activas()->get();
        if(count([$objPreguntas]))  {
            foreach($objPreguntas as $pregunta){
                echo $pregunta->pregunta.'<br>';
                $objP = DB::table('participantes_preguntas as pp')
                            ->selectRaw('count(*) as counta,pp.respuesta')
                            ->where('pp.preguntas_id','=',$pregunta->id)
                            ->where('pp.estado','=','1')
                            //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                            ->groupBy('pp.preguntas_id', 'pp.respuesta')
                            ->get();
                foreach($objP as $p){
                    echo 'respuesta' . $p->respuesta . ' num' . $p->counta . '<br>';
                 }
            }
        }
    }

    public function show45()
    {
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->get();
        $objParticipantes = null;

        if(count([$objCandidato]))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas

                    $objP = DB::table('participantes_preguntas as pp')
                                ->join('participantes', 'participantes.id', '=', 'pp.participantes_id')
                                ->selectRaw('count(*) as count,pp.respuesta')
                                ->where('pp.preguntas_id','=',$pregunta->id)
                                ->where('participantes.estado','=','1')
                                ->where('participantes.edad','=','45 en adelante')
                                ->where('pp.estado','=','1')
                                //->where('pp.id', '=', 'select max(p1.id) from participantes_preguntas p1 where p1.participantes_id = pp.participantes_id')
                                ->groupBy('pp.preguntas_id', 'pp.respuesta')
                                ->get();
                    foreach($objP as $p){
                        if($p->respuesta == $pregunta->pivot->respuesta_corta){
                                $porcentaje = $porcentaje + $p->count;
                            }
                        if($p->respuesta == $pregunta->pivot->opcion){
                                $porcentaje = $porcentaje + $p->count;
                            }
                     }
                }
                $objParticipantes = participantes::where('estado','=','1')->get();
                if(count($objParticipantes)){
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => $porcentaje/(count([$objCandidatoPregunta])*count($objParticipantes)),
                    );
                }else{
                    $arrayResultado[] = array(
                        'candidatosId' => $candidato->id,
                        'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                        'porcentaje' => 0,
                    );
                }
            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {
                $candidatoId[$clave] = $fila['candidatosId'];
                $candidato[$clave] = $fila['candidatos'];
                $porcentaje1[$clave] = $fila['porcentaje'];
            }

            array_multisort($porcentaje1, SORT_DESC, $arrayResultado);

            $arrayResultado = array_slice($arrayResultado, 0, 5);

            return $arrayResultado;
        }else{
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
