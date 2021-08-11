<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\partido;

use Storage;

class BackendPartidosController extends Controller
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
            'listaPartidos' => partido::paginate(10),
            'titulo' => 'Lista de Categorias',
        );
        return view('backend.partidos.listaPartido',$data);
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
        return view('backend.partidos.agregarPartido');
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
        //dd($request);
        if (!Auth::check()) {
            return redirect('backend/home');
        }
        $this->validate($request,[
            'nombre' =>  'required|unique:partidos,nombre',
            'numero' => 'required|unique:partidos,numero',
            'logo' => 'required',
            ]);

        $objPartido = new partido();
        $objPartido->nombre = $request->nombre;
        $objPartido->numero = $request->numero;
        $objPartido->estado = $request->estado;

    
        $img = $request->file('logo');
        $file_route = time().'_'.$img->getClientOriginalName();
        Storage::disk('imgJuego')->put($file_route, file_get_contents($img->getRealPath() ) );
        
        $objPartido->logo = $file_route;

        if($objPartido->save()){
            return redirect('backend/partidos/listaPartidos')->with('msj','Datos Guardados');
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
            $objPartido = partido::find($id);
            if($objPartido){
                $data = array(
                    'objPartido' => $objPartido,
                    'titulo' => 'Editar Partido',
                );
                return view('backend.partidos.editarPartido', $data);
            }else{
                return redirect('backend/partidos/listaPartidos')->with('msj','El partido político seleccionado no existe');
            }
        }else{
            return redirect('backend/partidos/listaPartidos')->with('msj','Por favor seleccione un partido político para poder editar');
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
            'nombre' =>  'required|unique:partidos,nombre,'.$id,
            'numero' => 'required|unique:partidos,numero,'.$id,
            //'logo' => 'required|image',
            ]);

        $objPartido = partido::find($id);
        $objPartido->nombre = $request->nombre;
        $objPartido->numero = $request->numero;
        $objPartido->estado = $request->estado;

        if($request->file('logo')){
            $img = $request->file('logo');
            $file_route = time().'_'.$img->getClientOriginalName();
            Storage::disk('imgJuego')->put($file_route, file_get_contents($img->getRealPath() ) );
            Storage::disk('imgJuego')->delete($request->imgOld);
            
            $objPartido->logo = $file_route;
        }

        if($objPartido->save()){
            return redirect('backend/partidos/listaPartidos')->with('msj','Datos Guardados Reg:'.$id);
        }else{
            return back()->with('error_msj','Datos no guardados Reg:'.$id);
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
            $objPartido = partido::find($id);
            if($objPartido){
                $objPartido->estado = $objPartido->estado == 1 ? 0 : 1;
                $objPartido->save();

                return redirect('backend/partidos/listaPartidos')->with('msj','Cambiado el estado Reg:'.$id);
            }else{
                return redirect('backend/partidos/listaPartidos')->with('msj','El partido político seleccionado no existe');
            }           
        }else{
            return redirect('backend/partidos/listaPartidos')->with('msj','Por favor seleccione un partido político para poder editar');
        }
    }
}
