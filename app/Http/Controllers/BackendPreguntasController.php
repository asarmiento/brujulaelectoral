<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\preguntas;

use Storage;

class BackendPreguntasController extends Controller
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
            'listaPreguntas' => preguntas::paginate(10),
            'titulo' => 'Lista de Preguntas',
        );
        return view('backend.preguntas.listaPregunta',$data);
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
        return view('backend.preguntas.agregarPregunta');
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
            'pregunta' =>  'required|unique:preguntas,pregunta',
            ]);

        $objPregunta = new preguntas();
        $objPregunta->pregunta = $request->pregunta;
        $objPregunta->descripcion = $request->descripcion;
        $objPregunta->estado = $request->estado;
    
        

        if($objPregunta->save()){
            return redirect('backend/preguntas/listaPreguntas')->with('msj','Datos Guardados');
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
            $objPregunta = preguntas::find($id);
            if($objPregunta){
                $data = array(
                    'objPregunta' => $objPregunta,
                    'titulo' => 'Editar Partido',
                );
                return view('backend.preguntas.editarPregunta', $data);
            }else{
                return redirect('backend/preguntas/listaPreguntas')->with('msj','La pregunta seleccionado no existe');
            }
        }else{
            return redirect('backend/preguntas/listaPreguntas')->with('msj','Por favor seleccione una pregunta para poder editar');
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
            'pregunta' =>  'required|unique:preguntas,pregunta,'.$id,
            ]);

        $objPregunta = preguntas::find($id);
        $objPregunta->pregunta = $request->pregunta;
        $objPregunta->descripcion = $request->descripcion;
        $objPregunta->estado = $request->estado;
    
        

        if($objPregunta->save()){
            return redirect('backend/preguntas/listaPreguntas')->with('msj','Datos Guardados');
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
        if (!Auth::check()) {
            return redirect('backend/home');
        }
    }

    public function cambiaEstado($id = ''){

        if (!Auth::check()) {
            return redirect('backend/home');
        }
        if($id){
            $objPregunta = preguntas::find($id);
            if($objPregunta){
                $objPregunta->estado = $objPregunta->estado == 1 ? 0 : 1;
                $objPregunta->save();

                return redirect('backend/preguntas/listaPreguntas')->with('msj','Cambiado el estado Reg:'.$id);
            }else{
                return redirect('backend/preguntas/listaPreguntas')->with('msj','La pregunta seleccionado no existe');
            }           
        }else{
            return redirect('backend/preguntas/listaPreguntas')->with('msj','Por favor seleccione una pregunta para poder editar');
        }
    }
}
