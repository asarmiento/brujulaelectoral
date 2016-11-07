<!-- Extendemos de la plantila por defecto creada -->
@extends('backend.layouts.default')

@section('contenido')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Candidatos <small> listado</small></h3>
              </div>

              
            </div>

            <div class="clearfix"></div>


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Listado Candidatos <small>Adminitración</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a href="{{ URL::to('backend/candidatos/agregarCandidato') }}"><i class="fa fa-plus"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      La administración de los candidatos del sistema
                      @if(session()->has('msj'))
                        <p class="alert alert-success" role="alert">{{ session('msj') }}</p>
                      @endif
                      @if(session()->has('msj_error'))
                        <p class="alert alert-danger" role="alert">{{ session('msj_error') }}</p>
                      @endif
                    </p>

                @if(count($listaCandidatos))

           
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Foto</th>
                          <th>Partido</th>
                          <th>Actualización</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($listaCandidatos as $candidato)
                        <tr>
                          <td> {{ $candidato->id }}</td>
                          <td> {{ $candidato->nombre }}</td>
                          <td> {{ $candidato->apellido }}</td>
                          <td width="200"> <img src="{{ asset('imgJuego/'.$candidato->foto) }}" class="img-responsive"></td>
                          <?php 
                            $objPartido = App\partido::find($candidato->partidos_id);
                            
                            if($objPartido){ 
                          ?>
                          <td> {{ $objPartido->nombre }}</td>
                          <?php }else{ ?>
                          <td> - </td>
                          <?php }?>
                          <td class="center">{{ $candidato->created_at }}</td>
                            <td class="center" >
                                @if($candidato->estado == 1)
                                    <a class="btn btn-danger btn-xs" href="{{ URL::to('backend/candidatos/cambiaEstadoCandidato/'.$candidato->id) }}" title="Desactivar candidato">
                                        <i class="glyphicon glyphicon-remove icon-white"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success btn-xs" href="{{ URL::to('backend/candidatos/cambiaEstadoCandidato/'.$candidato->id) }}" title="Activar candidato">
                                        <i class="glyphicon glyphicon-ok icon-white"></i>
                                    </a>
                                @endif
                                <!--a class="btn btn-success btn-xs" href="{{ URL::to('backend/partidos/detalleCandidato/'.$candidato->id) }}" title="Ver detalle de la candidato">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                </a-->
                                <a class="btn btn-info btn-xs" href="{{ URL::to('backend/candidatos/editarCandidato/'.$candidato->id) }}" title="Editar candidato">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                </a>
                                <!--a class="btn btn-danger btn-xs" href="{{ URL::to('backend/candidatos/eliminarCandidato/'.$candidato->id) }}" title="Eliminar candidato">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                </a-->
                            </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    

                    {{ $listaCandidatos->links() }}

                @endif
                  </div>
                </div>
              </div>

            </div>
        </div>

@stop