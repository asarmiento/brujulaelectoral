@extends('backend.layouts.default')

@section('contenido')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Respuestas</h3>
              </div>


            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista de Respuestas <small> Agregar</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   @if(session()->has('msj'))
                        <p class="alert alert-success" role="alert">{{ session('msj') }}</p>
                      @endif
                      @if(session()->has('msj_error'))
                        <p class="alert alert-danger" role="alert">{{ session('msj_error') }}</p>
                      @endif
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="{{ url('backend/respuestas/agregarRespuesta') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        @if(count($errors))
                            <p class="alert alert-danger">No se puede crear la respuesta debido a que existen errores en el formulario</p>
                        @endif

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="candidatos_id">Candidato <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="candidatos_id" class="col-md-7 col-xs-12 form-control" id="candidatos_id">
                         <option value="">Selecciones el candidato</option>
                          @if(count($listaCandidatos))
                             @foreach($listaCandidatos as $candidato)
                              <option value="{{ $candidato->id }}">{{ $candidato->nombre ." ". $candidato->apellido }}</option>
                             @endforeach
                          @endif
                          </select>
                          @if($errors->has('candidatos_id'))
                                <p class="alert alert-danger">{{ $errors->first('candidatos_id')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pregunta">Pregunta <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="preguntas_id" class="col-md-7 col-xs-12 form-control" id="preguntas_id">
                         <option value="">Selecciones la pregunta</option>
                          @if(count($listaPreguntas))
                             @foreach($listaPreguntas as $pregunta)
                              <option value="{{ $pregunta->id }}">{{ $pregunta->pregunta }}</option>
                             @endforeach
                          @endif
                          </select>
                          @if($errors->has('preguntas_id'))
                                <p class="alert alert-danger">{{ $errors->first('preguntas_id')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Respuesta</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="respuesta_corta" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="respuesta_corta" value="A favor"> &nbsp; A favor &nbsp;
                            </label>
                            <label class="btn btn-warning" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="respuesta_corta" value="Blanco"> BLANCO
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="respuesta_corta" value="En contra"> En contra
                            </label>
                          </div>
                          @if($errors->has('respuesta_corta'))
                                <p class="alert alert-danger">{{ $errors->first('respuesta_corta')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="respuesta_larga">Respuesta explicación<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="respuesta_larga" name="respuesta_larga" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la explicación de su respuesta">
                            @if($errors->has('respuesta_larga'))
                                <p class="alert alert-danger">{{ $errors->first('respuesta_larga')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opcion">Respuesta opción
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="opcion" name="opcion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la opción de su respuesta">
                            @if($errors->has('opcion'))
                                <p class="alert alert-danger">{{ $errors->first('opcion')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="respuesta_ff">Respuesta frente a frente<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="respuesta_ff" name="respuesta_ff" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la respuesta de frente a frente">
                            @if($errors->has('respuesta_ff'))
                                <p class="alert alert-danger">{{ $errors->first('respuesta_ff')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="estado" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="estado" value="1" checked="checked"> &nbsp; Activo &nbsp;
                            </label>
                            <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="estado" value="0"> Inactivo
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ URL::to('backend/respuestas/listaRespuestas') }}" class="btn btn-primary">Cancelar</a>
                          <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->
@endsection
