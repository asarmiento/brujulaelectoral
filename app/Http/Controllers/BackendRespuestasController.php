<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\candidatos;

use App\preguntas;

use App\candidatos_preguntas;

use Storage;

class BackendRespuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::check()) {
            return redirect('backend/home');
        }
        $data = array(
            'listaRespuestas' => candidatos_preguntas::paginate(50),
            'titulo' => 'Lista de Respuestas por candidato',
        );
        return view('backend.respuestas.listaRespuesta',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!Auth::check()) {
            return redirect('backend/home');
        }

        $data = array(
                    'listaCandidatos' => candidatos::activas()->get(),
                    'listaPreguntas' => preguntas::activas()->get(),
                );

        return view('backend.respuestas.agregarRespuesta',$data);
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
        if (!Auth::check()) {
            return redirect('backend/home');
        }
        $this->validate($request,[
            'candidatos_id' =>  'required',
            'preguntas_id' => 'required',
            'respuesta_corta' => 'required',
            'respuesta_larga' => 'required',
            'respuesta_ff' => 'required',
            ]);

        $objRespuesta = new candidatos_preguntas();
        $objRespuesta->candidatos_id = $request->candidatos_id;
        $objRespuesta->preguntas_id = $request->preguntas_id;
        $objRespuesta->respuesta_corta = $request->respuesta_corta;
        $objRespuesta->respuesta_larga = $request->respuesta_larga;
        $objRespuesta->opcion = $request->opcion;
        $objRespuesta->respuesta_ff = $request->respuesta_ff;
        $objRespuesta->estado = $request->estado;

    
        
        if($objRespuesta->save()){
            return redirect('backend/respuestas/listaRespuestas')->with('msj','Datos Guardados');
        }else{
            return back()->with('error_msj','Datos no guardados');
        };

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
        if (!Auth::check()) {
            return redirect('backend/home');
        }

        if($id){
            $objRespuesta = candidatos_preguntas::find($id);
            if($objRespuesta){
                $data = array(
                    'objRespuesta' => $objRespuesta,
                    'listaCandidatos' => candidatos::activas()->get(),
                    'listaPreguntas' => preguntas::activas()->get(),
                    'titulo' => 'Editar Partido',
                );
                return view('backend.respuestas.editarRespuesta', $data);
            }else{
                return redirect('backend/respuestas/listaRespuestas')->with('msj','La respuesta seleccionada no existe');
            }
        }else{
            return redirect('backend/respuestas/listaRespuestas')->with('msj','Por favor seleccione un candidato para poder editar');
        }
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
        if (!Auth::check()) {
            return redirect('backend/home');
        }
        $this->validate($request,[
            'candidatos_id' =>  'required',
            'preguntas_id' => 'required',
            'respuesta_corta' => 'required',
            'respuesta_larga' => 'required',
            'respuesta_ff' => 'required',
            ]);

        $objRespuesta = candidatos_preguntas::find($id);
        $objRespuesta->candidatos_id = $request->candidatos_id;
        $objRespuesta->preguntas_id = $request->preguntas_id;
        $objRespuesta->respuesta_corta = $request->respuesta_corta;
        $objRespuesta->respuesta_larga = $request->respuesta_larga;
        $objRespuesta->opcion = $request->opcion;
        $objRespuesta->respuesta_ff = $request->respuesta_ff;
        $objRespuesta->estado = $request->estado;

    
        
        if($objRespuesta->save()){
            return redirect('backend/respuestas/listaRespuestas')->with('msj','Datos Guardados');
        }else{
            return back()->with('error_msj','Datos no guardados');
        };
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

    public function cambiaEstado($id = ''){

        if (!Auth::check()) {
            return redirect('backend/home');
        }
        if($id){
            $objRespuesta = candidatos_preguntas::find($id);
            if($objRespuesta){
                $objRespuesta->estado = $objRespuesta->estado == 1 ? 0 : 1;
                $objRespuesta->save();

                return redirect('backend/respuestas/listaRespuestas')->with('msj','Cambiado el estado Reg:'.$id);
            }else{
                return redirect('backend/respuestas/listaRespuestas')->with('msj','El partido político seleccionado no existe');
            }           
        }else{
            return redirect('backend/respuestas/listaRespuestas')->with('msj','Por favor seleccione un partido político para poder editar');
        }
    }
}
