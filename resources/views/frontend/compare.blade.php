@extends('layouts.default')

@section('contenido')

    <section id="box-2-face">
        <div class="f2f-left"></div>
        <div class="f2f-right"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs=12 col-sm-12 col-md-12">
                    <h2><span>El Candidato </span><span class="headline">más</span> Compatible</h2>

                    <!-- formulario -->
                    <form class="form-inline" method="POST" action="{{ route('compare') }}">
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
                                <option value="">Todas</option>
                            </select>
                        </div>
                        <div class="form-group select">
                            <select class="form-control box-gender" name="rGenero">
                                <option value="">GÉNERO</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino">Masculino</option>
                                <option value="">Todos</option>
                            </select>
                        </div>
                        <div class="form-group select">
                            <select class="form-control box-age" name="rEdad">
                                <option value="">EDAD</option>
                                <option value="16 - 25">16 - 25</option>
                                <option value="25 - 35">25 - 35</option>
                                <option value="35 - 45">35 - 45</option>
                                <option value="45 en adelante">45 en adelante</option>
                                <option value="">Todos</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-main">Mostrar</button>
                    </form>
                    <!-- end formulario -->
                </div>
            </div>
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
            </div>
            <div class="bck-gray">
                <div class="container">
                    <div class="row">
                        <div id="category-label" class="col-xs=12 col-sm-12 col-md-12 mar-bottom">
                            <span>Nivel de Afinidad:</span>
                        </div>
                    @if($arrayResultado)
                        @foreach($arrayResultado as $key => $value)
                            <?php $objCandidatoPregunta = App\candidatos::find($key);
                              ?>
                              @if(count([$objCandidatoPregunta]))
                                  <!--barra 1 -->
                                      <div class="row">
                                          <p class="box-name col-xs-12 col-sm-3 col-md-2">{{$objCandidatoPregunta->completeName()}}</p>
                                          <div class="col-xs-12 col-sm-9 col-md-10">
                                              <div class="progress">
                                                  <img class="box-pic foto126"
                                                       src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}">
                                                  <div class="progress-bar" role="progressbar"
                                                       aria-valuenow="{{$value}}" aria-valuemin="0" aria-valuemax="100"
                                                       style="width: {{$value}}%;">
                                                      {{number_format($value)}}%
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                              @endif
                        @endforeach
                    @endif

                    <!-- descarga -->
                        <form method="POST" action="{{ url('/excel') }}">
                            <label>DESCARGAR:</label>
                            {{ csrf_field() }}
                            <input type="hidden" name="rPregunta"
                                   value="<?php if (isset($_POST['rPregunta'])) echo $_POST['rPregunta'] ?>">
                            <input type="hidden" name="rEdad"
                                   value="<?php if (isset($_POST['rEdad'])) echo $_POST['rEdad'] ?>">
                            <input type="hidden" name="rGenero"
                                   value="<?php if (isset($_POST['rGenero'])) echo $_POST['rGenero'] ?>">
                            <label class="checkbox-inline">
                                <input class="tipoDownload" type="checkbox" checked="checked" id="inlineCheckbox1"
                                       name="tipoDownload" value="excel"> Excel
                            </label>
                            <label class="checkbox-inline">
                                <input class="tipoDownload" type="checkbox" id="inlineCheckbox1" neme="tipoDownload"
                                       value="csv"> CSV
                            </label>
                            <button type="submit" class="btn btn-main">Descargar</button>
                        </form>
                    </div>
                </div>
            </div><!-- end estadisticas -->

        </div>

    </section>
    <section id="box-game">
        <div class="container">
            <div class="row">
                <div class="col-xs=12 col-sm-12 col-md-6">
                    <h2><span>¿Quién es tu </span>Candidato afín?</h2>
                    <h4></h4>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        Después de grupos focales con jóvenes de entre 20 y 30 años, la revista digital Plan V, con el
                        apoyo de la Fundación Ciudadanía y Desarrollo, desarrolló este portal para que los electores,
                        sobre todo los jóvenes, encuentren al candidato presidencial que más se acerque a sus
                        aspiraciones y creencias. Su contenido fue actualizado el 27 de enero de 2017 con las respuestas
                        del candidato oficialista Lenín Moreno, el único aspirante que estaba pendiente. No olvides
                        hacer clic en <i>Opciones</i> para afinar más tu voto.
                        <br/>¿Coincides con ellos?
                    </div>
                    <a href="{{URL::to('juego-login')}}" class="btn btn-main">Juega y Averígualo</a>
                    <div class="quiz-game"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
