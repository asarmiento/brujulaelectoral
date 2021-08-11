<!-- Extendemos de la plantila por defecto creada -->
@extends('backend.layouts.default')

@section('contenido')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Candidatos</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Candidatos <small> Agregar</small></h2>
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="{{ url('backend/candidatos/editarCandidato/'.$objCandidato->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="text" name="imgOld" class="hide" value="{{ $objCandidato->foto }}">

                        @if(count($errors))
                            <p class="alert alert-danger">No se puede editar la categoria debido a que existen errores en el formulario</p>
                        @endif

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" value="{{ $objCandidato->nombre }}">
                            @if($errors->has('nombre'))
                                <p class="alert alert-danger">{{ $errors->first('nombre')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido">Apellido <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="apellido" name="apellido" required="required" class="form-control col-md-7 col-xs-12" value="{{ $objCandidato->apellido }}">
                            @if($errors->has('apellido'))
                                <p class="alert alert-danger">{{ $errors->first('apellido')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="numero">Partido político <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="partidos" class="col-md-7 col-xs-12 form-control" id="partidos">
                         <option value="">Selecciones el partido político</option>
                          @if(count($listaPartidos))
                             @foreach($listaPartidos as $partido)
                              @if($partido->id == $objCandidato->partidos_id)
                                <option selected="selected" value="{{ $partido->id }}">{{ $partido->nombre }}</option>
                              @endif
                                <option value="{{ $partido->id }}">{{ $partido->nombre }}</option>
                             @endforeach 
                          @endif
                          </select> 
                          @if($errors->has('partido'))
                                <p class="alert alert-danger">{{ $errors->first('partido')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="foto" class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="foto" class="form-control col-md-7 col-xs-12" type="file" name="foto">
                          @if($errors->has('foto'))
                                <p class="alert alert-danger">{{ $errors->first('foto')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="binomio">Binomio
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="binomio" name="binomio" required="required" class="form-control col-md-7 col-xs-12" value="{{ $objCandidato->binomio }}">
                            @if($errors->has('binomio'))
                                <p class="alert alert-danger">{{ $errors->first('binomio')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="seguridad">Seguridad
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <small><a onclick="javascript: replaceEditor('seguridad')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Cargar Editor</a></small>
                          <textarea id="seguridad" name="seguridad" required="required" class="form-control col-md-7 col-xs-12" >{{ $objCandidato->seguridad }}</textarea> 
                            @if($errors->has('seguridad'))
                                <p class="alert alert-danger">{{ $errors->first('seguridad')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="empleo">Empleo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <small><a onclick="javascript: replaceEditor('empleo')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Cargar Editor</a></small>
                          <textarea id="empleo" name="empleo" required="required" class="form-control col-md-7 col-xs-12" >{{ $objCandidato->empleo }}</textarea> 
                            @if($errors->has('empleo'))
                                <p class="alert alert-danger">{{ $errors->first('empleo')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agricultura">Agricultura
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <small><a onclick="javascript: replaceEditor('agricultura')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Cargar Editor</a></small>
                          <textarea id="agricultura" name="agricultura" required="required" class="form-control col-md-7 col-xs-12" >{{ $objCandidato->agricultura }}</textarea> 
                            @if($errors->has('agricultura'))
                                <p class="alert alert-danger">{{ $errors->first('agricultura')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="educacion">Educación
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <small><a onclick="javascript: replaceEditor('educacion')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Cargar Editor</a></small>
                          <textarea id="educacion" name="educacion" required="required" class="form-control col-md-7 col-xs-12" >{{ $objCandidato->educacion }}</textarea> 
                            @if($errors->has('educacion'))
                                <p class="alert alert-danger">{{ $errors->first('educacion')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salud">Salud
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <small><a onclick="javascript: replaceEditor('salud')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Cargar Editor</a></small>
                          <textarea id="salud" name="salud" required="required" class="form-control col-md-7 col-xs-12" >{{ $objCandidato->salud }}</textarea> 
                            @if($errors->has('salud'))
                                <p class="alert alert-danger">{{ $errors->first('salud')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="democracia">Democracia
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <small><a onclick="javascript: replaceEditor('democracia')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Cargar Editor</a></small>
                          <textarea id="democracia" name="democracia" required="required" class="form-control col-md-7 col-xs-12" >{{ $objCandidato->democracia }}</textarea> 
                            @if($errors->has('democracia'))
                                <p class="alert alert-danger">{{ $errors->first('democracia')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="economia">Economía
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <small><a onclick="javascript: replaceEditor('economia')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Cargar Editor</a></small>
                          <textarea id="economia" name="economia" required="required" class="form-control col-md-7 col-xs-12" >{{ $objCandidato->economia }}</textarea> 
                            @if($errors->has('economia'))
                                <p class="alert alert-danger">{{ $errors->first('economia')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ambiente">Ambiente
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <small><a onclick="javascript: replaceEditor('ambiente')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Cargar Editor</a></small>
                          <textarea id="ambiente" name="ambiente" required="required" class="form-control col-md-7 col-xs-12" >{{ $objCandidato->ambiente }}</textarea> 
                            @if($errors->has('ambiente'))
                                <p class="alert alert-danger">{{ $errors->first('ambiente')}}</p>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="estado" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default {{ $objCandidato->estado == 1 ? 'active' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="estado" value="1" {{ $objCandidato->estado == 1 ? 'checked=checked' : '' }}> &nbsp; Activo &nbsp;
                            </label>
                            <label class="btn btn-primary {{ $objCandidato->estado == 0 ? 'active' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="estado" value="0" {{ $objCandidato->estado == 0 ? 'checked=checked' : '' }}> Inactivo
                            </label>
                          </div>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ URL::to('backend/candidatos/listaCandidatos') }}" class="btn btn-primary">Cancelar</a>
                          <button type="submit" class="btn btn-warning">Modificar</button>
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
@stop