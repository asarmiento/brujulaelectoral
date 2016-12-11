@extends('layouts.default')

@section('contenido')
<section id="box-game">
        <div class="container">
            <div class="row">
                <div class="col-xs=12 col-sm-12 col-md-6">
                    <h2><span>¿Quién es tu </span>candidato afín?</h2>
                    <h4></h4>
                    <div class="col-xs=12 col-sm-12 col-md-6">Después de grupos focales con jóvenes de entre 20 y 26 años, el equipo periodístico de la revista digital Plan V, con el apoyo de la Fundación Ciudadanía y Desarrollo, desarrolló este portal para que los electores, sobre todo los jóvenes, encuentren al candidato presidencial que más se acerque a sus aspiraciones y creencias. </div>
                    <div class="col-xs=12 col-sm-12 col-md-6">Desde economía hasta libertades sexuales, esto fue lo respondieron los presidenciales a las 10 inquietudes que tiene este sector sobre el futuro del país. ¿Coincides con ellos?
</div>
                    <a href="{{URL::to('juego-login')}}" class="btn btn-main">Juega y Averígualo</a>
                    <div class="quiz-game"></div>
                </div>
            </div>
        </div>
    </section>
    <section id="box-metrics">
        <!-- filtros -->
        <div class="container">
            <div class="row">
                <div class="col-xs=12 col-sm-12 col-md-12">
                    <h2><span>Ranking </span><span class="headline">del</span> Juego</h2>
                    <!-- formulario -->
                    <form class="form-inline" method="POST" action="{{ url('/') }}">
                    {{ csrf_field() }}
                    <label class="head-label" for="titulo">Ordenar</label>
                      <div class="form-group select">
                        <select class="form-control box-question" name="rPregunta">
                          <option value="">PREGUNTAS</option>
                          <?php
                          foreach ($objPreguntas as $pregunta ) {
                          ?>
                          <option value="{{ $pregunta->id }}">{{ $pregunta->pregunta }}</option>
                          <?php
                        }
                          ?>
                        </select>
                      </div>
                      <div class="form-group select">
                        <select class="form-control box-gender" name="rGenero">
                          <option value="">GÉNERO</option>
                          <option value="Femenino">Femenino</option>
                          <option value="Masculino">Masculino</option>
                          <option value="GLTB">GLTB</option>
                        </select>
                      </div>
                      <div class="form-group select">
                        <select class="form-control box-age" name="rEdad">
                          <option value="">EDAD</option>
                          <option value="16 - 25">16 - 25</option>
                          <option value="25 - 35">25 - 35</option>
                          <option value="35 - 45">35 - 45</option>
                          <option value="45 en adelante">45 en adelante</option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-main">Mostrar</button>
                    </form>
                    <!-- end formulario -->
                </div>
            </div>
        </div><!-- end filtros -->
        <!-- categorias resultados -->
        <div class="bck-gray brd-btm">
            <div class="container">
                <div class="row">
                    <div id="category-label" class="col-xs=12 col-sm-6 col-md-8">
                        <span>pregunta:</span>
                        <p>{{ $consulta[0] }}</p>
                    </div>
                    <div id="category-label" class="col-xs=12 col-sm-3 col-md-2 brd-lft">
                        <span>género:</span>
                        <p>{{ $consulta[2] }}</p>
                    </div>
                    <div id="category-label" class="col-xs=12 col-sm-3 col-md-2 brd-lft">
                        <span>edad:</span>
                        <p>{{ $consulta[1] }}</p>
                    </div>
                    
                </div>
            </div>
        </div><!-- end resultados -->
        
        <!-- filtros -->
        <div class="container">
            <div class="row">
                    <!-- formulario -->
                    <form class="form-inline" method="POST" action="{{ url('/') }}">
                    {{ csrf_field() }}
                    <label class="head-label" for="titulo">Ordenar</label>
                      <div class="form-group select">
                        <select class="form-control box-question" name="rPregunta">
                          <option value="">PREGUNTAS</option>
                          <?php
                          foreach ($objPreguntas as $pregunta ) {
                          ?>
                          <option value="{{ $pregunta->id }}">{{ $pregunta->pregunta }}</option>
                          <?php
                        }
                          ?>
                        </select>
                      </div>
                      <div class="form-group select">
                        <select class="form-control box-gender" name="rGenero">
                          <option value="">GÉNERO</option>
                          <option value="Femenino">Femenino</option>
                          <option value="Masculino">Masculino</option>
                          <option value="GLTB">GLTB</option>
                        </select>
                      </div>
                      <div class="form-group select">
                        <select class="form-control box-age" name="rEdad">
                          <option value="">EDAD</option>
                          <option value="16 - 25">16 - 25</option>
                          <option value="25 - 35">25 - 35</option>
                          <option value="35 - 45">35 - 45</option>
                          <option value="45 en adelante">45 en adelante</option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-main">Mostrar</button>
                    </form>
                    <!-- end formulario -->
            </div>
        </div><!-- end filtros -->
    </section>
    <section id="box-2-face">
        <div class="f2f-left"></div>
        <div class="f2f-right"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs=12 col-sm-12 col-md-12">
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
