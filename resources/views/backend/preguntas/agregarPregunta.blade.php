@extends('backend.layouts.default')

@section('contenido')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pregunta</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Preguntas <small> Agregar</small></h2>
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="{{ url('backend/preguntas/agregarPregunta') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        @if(count($errors))
                            <p class="alert alert-danger">No se puede editar la categoria debido a que existen errores en el formulario</p>
                        @endif

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pregunta">Pregunta <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="pregunta" name="pregunta" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la pregunta">
                            @if($errors->has('pregunta'))
                                <p class="alert alert-danger">{{ $errors->first('pregunta')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">Descripción <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="descripcion" name="descripcion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la descripción">
                          @if($errors->has('descripcion'))
                                <p class="alert alert-danger">{{ $errors->first('descripcion')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opcion_1">Opción 1
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="opcion_1" name="opcion_1" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la Opción 1">
                          @if($errors->has('opcion_1'))
                                <p class="alert alert-danger">{{ $errors->first('opcion_1')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opcion_2">Opción 2
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="opcion_2" name="opcion_2" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la Opción 2">
                          @if($errors->has('opcion_2'))
                                <p class="alert alert-danger">{{ $errors->first('opcion_2')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opcion_3">Opción 3
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="opcion_3" name="opcion_3" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la Opción 3">
                          @if($errors->has('opcion_3'))
                                <p class="alert alert-danger">{{ $errors->first('opcion_3')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opcion_4">Opción 4
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="opcion_4" name="opcion_4" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la Opción 4">
                          @if($errors->has('opcion_4'))
                                <p class="alert alert-danger">{{ $errors->first('opcion_4')}}</p>
                            @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opcion_5">Opción 5
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="opcion_5" name="opcion_5" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la Opción 5">
                          @if($errors->has('opcion_5'))
                                <p class="alert alert-danger">{{ $errors->first('opcion_5')}}</p>
                            @endif
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="estado" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="estado" value="1" checked="checked"> &nbsp; Activo &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="estado" value="0"> Inactivo
                            </label>
                          </div>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ URL::to('backend/preguntas/listaPreguntas') }}" class="btn btn-primary">Cancelar</a>
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
