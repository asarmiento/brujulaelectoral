<!-- Extendemos de la plantila por defecto creada -->
@extends('backend.layouts.default')

@section('contenido')

            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Preguntas <small> listado</small></h3>
              </div>

              
            </div>

            <div class="clearfix"></div>


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Listado Preguntas <small>Adminitración</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a href="{{ URL::to('backend/preguntas/agregarPregunta') }}"><i class="fa fa-plus"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      La administración de las preguntas para el juego
                      @if(session()->has('msj'))
                        <p class="alert alert-success" role="alert">{{ session('msj') }}</p>
                      @endif
                      @if(session()->has('msj_error'))
                        <p class="alert alert-danger" role="alert">{{ session('msj_error') }}</p>
                      @endif
                    </p>

                @if(count($listaPreguntas))

           
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Pregunta</th>
                          <th>Descripción</th>
                          <th>Creación</th>
                          <th>Actualización</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($listaPreguntas as $pregunta)
                        <tr>
                          <td> {{ $pregunta->id }}</td>
                          <td> {{ $pregunta->pregunta }}</td>
                          <td> {{ $pregunta->descripcion }}</td>
                          <td class="center">{{ $pregunta->created_at }}</td>
                            <td class="center">{{ $pregunta->updated_at }}</td>
                            <td class="center" >
                                @if($pregunta->estado == 1)
                                    <a class="btn btn-danger btn-xs" href="{{ URL::to('backend/preguntas/cambiaEstadoPregunta/'.$pregunta->id) }}" title="Desactivar pregunta">
                                        <i class="glyphicon glyphicon-remove icon-white"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success btn-xs" href="{{ URL::to('backend/preguntas/cambiaEstadoPregunta/'.$pregunta->id) }}" title="Activar pregunta">
                                        <i class="glyphicon glyphicon-ok icon-white"></i>
                                    </a>
                                @endif
                                <!--a class="btn btn-success btn-xs" href="{{ URL::to('backend/preguntas/detallepregunta/'.$pregunta->id) }}" title="Ver detalle de la pregunta">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                </a-->
                                <a class="btn btn-info btn-xs" href="{{ URL::to('backend/preguntas/editarPregunta/'.$pregunta->id) }}" title="Editar pregunta">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                </a>
                                <!--a class="btn btn-danger btn-xs" href="{{ URL::to('backend/preguntas/eliminarpregunta/'.$pregunta->id) }}" title="Eliminar pregunta">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                </a-->
                            </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    

                    {{ $listaPreguntas->links() }}

                @endif
                  </div>
                </div>
              </div>

            </div>
        </div>

@stop