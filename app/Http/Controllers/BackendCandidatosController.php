<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\candidatos;

use App\partido;

use Storage;

class BackendCandidatosController extends Controller
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
            'listaCandidatos' => candidatos::paginate(10),
            'titulo' => 'Lista de Candidatos',
        );
        return view('backend.candidatos.listaCandidato',$data);
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
                    'listaPartidos' => partido::activas()->get(),
                );
        return view('backend.candidatos.agregarCandidato',$data);
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
            'nombre' =>  'required',
            'apellido' => 'required',
            'partidos' => 'required',
            'foto' => 'required',
            ]);

        $candidato = new candidatos();
        $candidato->nombre = $request->nombre;
        $candidato->apellido = $request->apellido;
        $candidato->estado = $request->estado;
        $candidato->partidos_id = $request->partidos;

    
        $img = $request->file('foto');
        $file_route = time().'_'.$img->getClientOriginalName();
        Storage::disk('imgJuego')->put($file_route, file_get_contents($img->getRealPath() ) );
        
        $candidato->foto = $file_route;

        if($candidato->save()){
            return redirect('backend/candidatos/listaCandidatos')->with('msj','Datos Guardados');
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
            $objCandidato = candidatos::find($id);
            if($objCandidato){
                $data = array(
                    'objCandidato' => $objCandidato,
                    'listaPartidos' => partido::activas()->get(),
                    'titulo' => 'Editar Partido',
                );
                return view('backend.candidatos.editarCandidato', $data);
            }else{
                return redirect('backend/candidatos/listaCandidato')->with('msj','El candidato seleccionado no existe');
            }
        }else{
            return redirect('backend/candidatos/listaCandidato')->with('msj','Por favor seleccione un candidato para poder editar');
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
            'nombre' =>  'required',
            'apellido' => 'required',
            'partidos' => 'required',
            //'foto' => 'required',
            ]);

        $candidato = candidatos::find($id);
        $candidato->nombre = $request->nombre;
        $candidato->apellido = $request->apellido;
        $candidato->estado = $request->estado;
        $candidato->partidos_id = $request->partidos;

        if($request->file('foto')){

            $img = $request->file('foto');
            $file_route = time().'_'.$img->getClientOriginalName();
            Storage::disk('imgJuego')->put($file_route, file_get_contents($img->getRealPath() ) );
            Storage::disk('imgJuego')->delete($request->imgOld);            

            $candidato->foto = $file_route;
        }
        
        

        if($candidato->save()){
            return redirect('backend/candidatos/listaCandidatos')->with('msj','Datos Guardados');
        }else{
            return back()->with('error_msj','Datos no guardados');
        }
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
            $objCandidato = candidatos::find($id);
            if($objCandidato){
                $objCandidato->estado = $objCandidato->estado == 1 ? 0 : 1;
                $objCandidato->save();

                return redirect('backend/candidatos/listaCandidatos')->with('msj','Cambiado el estado Reg:'.$id);
            }else{
                return redirect('backend/candidatos/listaCandidatos')->with('msj','El candidato seleccionado no existe');
            }           
        }else{
            return redirect('backend/candidatos/listaCandidatos')->with('msj','Por favor seleccione un candidato para poder editar');
        }
    }
}
