<!-- Extendemos de la plantila por defecto creada -->
@extends('backend.layouts.default')

@section('contenido')

            <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Respuestas por candidato <small> listado</small></h3>
              </div>

              
            </div>

            <div class="clearfix"></div>


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Listado Respuestas por candidato <small>Adminitración</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a href="{{ URL::to('backend/respuestas/agregarRespuesta') }}"><i class="fa fa-plus"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      La administración de las respuestas por candidato
                      @if(session()->has('msj'))
                        <p class="alert alert-success" role="alert">{{ session('msj') }}</p>
                      @endif
                      @if(session()->has('msj_error'))
                        <p class="alert alert-danger" role="alert">{{ session('msj_error') }}</p>
                      @endif
                    </p>

                @if(count($listaRespuestas))

           
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Candidato</th>
                          <th>Pregunta</th>
                          <th>Respuesta corta</th>
                          <th>Respuesta larga</th>
                          <th>Actualización</th>
                          <th>Creación</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($listaRespuestas as $respuesta)
                        <tr>
                          <td> {{ $respuesta->id }}</td>
                          <?php 
                            $objCandidato = App\candidatos::find($respuesta->candidatos_id);
                            
                            if($objCandidato){ 
                          ?>
                          <td> {{ $objCandidato->nombre }}</td>
                          <?php }else{ ?>
                          <td> - </td>
                          <?php }?>
                          
                          <?php 
                            $objPregunta = App\preguntas::find($respuesta->preguntas_id);
                            
                            if($objPregunta){ 
                          ?>
                          <td> {{ $objPregunta->pregunta }}</td>
                          <?php }else{ ?>
                          <td> - </td>
                          <?php }?>
                          
                          <td> {{ $respuesta->respuesta_corta }}</td>
                          <td> {{ $respuesta->respuesta_larga }}</td>
                          <td class="center">{{ $respuesta->created_at }}</td>
                            <td class="center">{{ $respuesta->updated_at }}</td>
                            <td class="center" >
                                @if($respuesta->estado == 1)
                                    <a class="btn btn-danger btn-xs" href="{{ URL::to('backend/respuestas/cambiaEstadoRespuesta/'.$respuesta->id) }}" title="Desactivar respuesta">
                                        <i class="glyphicon glyphicon-remove icon-white"></i>
                                    </a>
                                @else
                                    <a class="btn btn-success btn-xs" href="{{ URL::to('backend/respuestas/cambiaEstadoRespuesta/'.$respuesta->id) }}" title="Activar respuesta">
                                        <i class="glyphicon glyphicon-ok icon-white"></i>
                                    </a>
                                @endif
                                <!--a class="btn btn-success btn-xs" href="{{ URL::to('backend/respuestas/detalleRespuesta/'.$respuesta->id) }}" title="Ver detalle de la respuesta">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                </a-->
                                <a class="btn btn-info btn-xs" href="{{ URL::to('backend/respuestas/editarRespuesta/'.$respuesta->id) }}" title="Editar respuesta">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                </a>
                                <!--a class="btn btn-danger btn-xs" href="{{ URL::to('backend/respuestas/eliminarRespuesta/'.$respuesta->id) }}" title="Eliminar respuesta">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                </a-->
                            </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    

                    {{ $listaRespuestas->links() }}

                @endif
                  </div>
                </div>
              </div>

            </div>
        </div>

@stop