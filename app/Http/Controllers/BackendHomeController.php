<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\candidatos;
use App\preguntas;
use App\participantes;


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
        $objCandidato = candidatos::activas()->get();
        if(count($objCandidato))  {
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
                    }
                }
                $arrayResultado[] = array(
                    'candidatos' => $candidato->nombre .' '. $candidato->apellido,
                    'porcentaje' => $porcentaje*100/(count($objCandidatoPregunta)*count($objParticipantes)),
                    );
            }
            /* --- FIN FUNCTION ---- */

            foreach ($arrayResultado as $clave => $fila) {
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
        if(count($objCandidato))  {

            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->genero == 'Femenino' ){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
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

            foreach ($arrayResultado as $clave => $fila) {
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
        if(count($objCandidato))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->genero == 'Masculino' ){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
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

            foreach ($arrayResultado as $clave => $fila) {
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
        if(count($objCandidato))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->genero == 'GLTB' ){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
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

            foreach ($arrayResultado as $clave => $fila) {
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
        if(count($objCandidato))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->edad == '16 - 25' ){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
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

            foreach ($arrayResultado as $clave => $fila) {
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
        if(count($objCandidato))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->edad == '25 - 35' ){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
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

            foreach ($arrayResultado as $clave => $fila) {
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
        if(count($objCandidato))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->edad == '35 - 45' ){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
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

            foreach ($arrayResultado as $clave => $fila) {
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

    public function show45()
    {
        //Obtengo el objeto de los candidatos
        $objCandidato = candidatos::activas()->get();
        if(count($objCandidato))  {
            foreach($objCandidato as $candidato){
                $porcentaje = 0;
                //obtengo el objeto preguntas por candidato
                $objCandidatoPregunta = candidatos::find($candidato->id)->preguntas()->get();            
                foreach($objCandidatoPregunta as $pregunta){
                    //obtengo el objeto de los participantes que terminaron de cotestar todas las preguntas
                    $objParticipantes = participantes::where('estado','=','1')->get();
                    foreach ($objParticipantes as $participante) {
                        if($participante->edad == '45 en adelante' ){
                            $objPreguntaParticipante = preguntas::find($pregunta->id)->participantes()->where('participantes_preguntas.participantes_id','=',$participante->id)->orderBy('pivot_id','desc')->first();
                            if($objPreguntaParticipante->pivot->respuesta == $pregunta->pivot->respuesta_corta){
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

            foreach ($arrayResultado as $clave => $fila) {
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
