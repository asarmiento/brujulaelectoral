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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">Descripción
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="descripcion" name="descripcion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ingrese la descripción">
                          @if($errors->has('descripcion'))
                                <p class="alert alert-danger">{{ $errors->first('descripcion')}}</p>
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
