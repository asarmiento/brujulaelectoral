<!-- Extendemos de la plantila por defecto creada -->
@extends('backend.layouts.default')

@section('contenido')

            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Partidos Políticos <small> listado</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Listado Partidos Políticos <small>Adminitración</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a href="{{ URL::to('backend/partidos/agregarPartido') }}"><i class="fa fa-plus"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      La administración de los partidos políticos del sistema
                      @if(session()->has('msj'))
                        <p class="alert alert-success" role="alert">{{ session('msj') }}</p>
                      @endif
                      @if(session()->has('msj_error'))
                        <p class="alert alert-danger" role="alert">{{ session('msj_error') }}</p>
                      @endif
                    </p>

                @if(count($listaPartidos))

           
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Número</th>
                          <th>Logo</th>
                          <th>Creación</th>
                          <th>Actualización</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($listaPartidos as $partido)
                        <tr>
                          <td> {{ $partido->id }}</td>
                          <td> {{ $partido->nombre }}</td>
                          <td> {{ $partido->numero }}</td>
                          <td width="200"> <img src="{{ asset('imgJuego/'.$partido->logo) }}" class="img-responsive"></td>
                          <td class="center">{{ $partido->created_at }}</td>
                            <td class="center">{{ $partido->updated_at }}</td>
                            <td class="center" >
                                @if($partido->estado == 1)
                                    <a class="btn btn-danger btn-xs" href="{{ URL::to('backend/partidos/cambiaEstadoPartido/'.$partido->id) }}" title="Desactivar partido">
                                        <i class="glyphicon glyphicon-remove icon-white"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success btn-xs" href="{{ URL::to('backend/partidos/cambiaEstadoPartido/'.$partido->id) }}" title="Activar partido">
                                        <i class="glyphicon glyphicon-ok icon-white"></i>
                                    </a>
                                @endif
                                <!--a class="btn btn-success btn-xs" href="{{ URL::to('backend/partidos/detallepartido/'.$partido->id) }}" title="Ver detalle de la partido">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                </a-->
                                <a class="btn btn-info btn-xs" href="{{ URL::to('backend/partidos/editarPartido/'.$partido->id) }}" title="Editar partido">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                </a>
                                <!--a class="btn btn-danger btn-xs" href="{{ URL::to('backend/partidos/eliminarpartido/'.$partido->id) }}" title="Eliminar partido">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                </a-->
                            </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    {{ $listaPartidos->links() }}

                @endif
                  </div>
                </div>
              </div>

            </div>
        </div>
@stop