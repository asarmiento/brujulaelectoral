@extends('layouts.default')

@section('contenido')
<section id="box-game">
    <div class="container">
      <div class="row">
        <div class="col-xs=12 col-sm-12 col-md-6">
          <h2><span>¿Quién es tu </span>Candidato afin?</h2>
          <h4>Juego Electoral</h4>
          <div class="col-xs=12 col-sm-12 col-md-12">
            

          <!-- formulario login -->
          <form id="form-3" class="form-horizontal col-xs-12 col-sm-12 col-md-offset-2 col-md-8" method="POST" action="{{ url('juego-login') }}" >
          {{ csrf_field() }}

          @if(count($errors))
              <p class="alert alert-danger">No se puede empezar el juego porque existen errores en el formulario</p>
          @endif

          @if(session()->has('error_msj'))
            <p class="alert alert-danger" role="alert">{{ session('error_msj') }}</p>
          @endif

            <div class="form-group">
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre o Seudónimo">
              @if($errors->has('nombre'))
                  <p class="alert alert-danger">{{ $errors->first('nombre')}}</p>
              @endif    
            </div>
            <div class="form-group select">
              <select class="form-control" id="genero" name="genero">
                <option value="">TU GÉNERO</option>
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
                <!--option value="GLTB">GLTB</option-->
              </select>
              @if($errors->has('genero'))
                  <p class="alert alert-danger">{{ $errors->first('genero')}}</p>
              @endif
            </div>
            <div class="form-group select">
              <select class="form-control" id="edad" name="edad">
              <option value="">TU EDAD</option>
              <option value="16 - 25">16 - 25</option>
              <option value="25 - 35">25 - 35</option>
              <option value="35 - 45">35 - 45</option>
              <option value="45 en adelante">45 en adelante</option>
            </select>
              @if($errors->has('edad'))
                  <p class="alert alert-danger">{{ $errors->first('edad')}}</p>
              @endif
            </div>
            <button type="submit" class="btn btn-main">Empezar el juego</button>
          </form>
          <!-- end formulario login -->

          </div>
          
          <div class="quiz-game"></div>
        </div>
      </div>
    </div>
  </section>

  <section id="box-2-face">
    <div class="f2f-left"></div>
    <div class="f2f-right"></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <h2><span>Frente </span><span class="headline">a</span> Frente</h2>
          <h4>Compara las Propuestas Presidenciales</h4>
          


          <!-- formulario -->
          <form id="form-2" class="form-inline col-xs-offset-2 col-xs-8 col-sm-12 col-md-offset-2 col-md-8" method="POST" action="{{ url('frente-a-frente') }}">
          {{ csrf_field() }}
            <div class="form-group select">
              <select id="frente_1" name="frente_1" class="form-control box-candidate classic">
                    <option>ESCOGE UN CANDIDATO</option>
                    @if(count($objCandidato))
                                  @foreach($objCandidato as $candidato)
                                    <option value="{{ $candidato->id }}">{{ $candidato->nombre }} {{ $candidato->apellido }}</option>
                                  @endforeach
                                @endif
                  </select>
                  </div>
                  <div class="form-group select">
                    <select id="frente_2" name="frente_2" class="form-control box-candidate classic">
                    <option>ESCOGE UN CANDIDATO</option>
                    @if(count($objCandidato))
                                  @foreach($objCandidato as $candidato)
                                    <option value="{{ $candidato->id }}">{{ $candidato->nombre }} {{ $candidato->apellido }}</option>
                                  @endforeach
                                @endif
                  </select>
            </div>
            <button type="submit" class="btn btn-main">Comparar</button>
          </form>
          <!-- end formulario -->
        



        </div>
      </div>
    </div>
    
  </section>
@endsection