@extends('layouts.default')

@section('contenido')

    @if(!session()->has('participante'))
        <?php
        return redirect('juego-login')->with('error_msj', 'Ingrese sus datos para participar');
        //{{ session('participante') }}
        ?>
    @endif

    <section id="box-game">
        <div class="container">
            <div class="row">
                <!-- titulo -->
                <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                    <h2><span>¿Quién es tu </span>Candidato afín?</h2>
                    <h4></h4>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">

                </div>
                <!-- juego -->
                <div class="col-xs-2 col-sm-2 col-md-3">
                    <p class="txt-question">Pregunta</p>
                    <div class="number">
                      @if(isset($objPreguntaAct))
                        {{ $objPreguntaAct->id  }}.
                        @endif
                    </div>
                </div>
                <div class="col-xs-10 col-sm-6 col-md-5">

                    @if(isset($objPreguntaAct) )
                        <h3 class="headline-3">{{ $objPreguntaAct->pregunta }}</h3>
                        <p class="txt-context-2">{{ $objPreguntaAct->descripcion }}</p>
                    @endif

                    <p class="info-question"><span>{{ $objPreguntaAct->id  }}</span> de {{ count($objPreguntas) }}
                        preguntas</p>
                    <p></p>
                </div>
                
                <div class="col-xs-12 col-sm-4 col-md-4 ">
                    <form id="form-voto" class="form-horizontal col-xs-12 col-sm-12  col-md-12" method="POST"
                          action="{{ route('storeJuego') }}">
                        {{ csrf_field() }}
                        <button class="btn btn-success" id="btn-yes">A favor</button>
                        <input type="hidden" name="respuesta" id="respuesta" value="A favor">
                        <input type="hidden" name="pregunta" id="pregunta" value="{{ $objPreguntaAct->id }}">
                    </form>
                    
                    <form id="form-votos" class="form-horizontal col-xs-12 col-sm-12  col-md-12" method="POST"
                          action="{{ route('storeJuego') }}">
                        {{ csrf_field() }}
                        <button class="btn btn-danger" id="btn-no">En contra</button>
                        <input type="hidden" name="respuesta" id="respuesta" value="En contra">
                        <input type="hidden" name="pregunta" id="pregunta" value="{{ $objPreguntaAct->id }}">
                    </form>
                    
                    <form id="form-votos" class="form-horizontal col-xs-12 col-sm-12  col-md-12" method="POST"
                          action="{{ route('storeJuego') }}">
                        {{ csrf_field() }}
                        <button class="btn btn-light" id="btn-neutro">Neutro</button>
                        <input type="hidden" name="respuesta" id="respuesta" value="Neutro">
                        <input type="hidden" name="pregunta" id="pregunta" value="{{ $objPreguntaAct->id }}">
                    </form>

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
                    <h4>También tenemos</h4>
                    <h2><span>Cara </span><span class="headline">a</span> Cara</h2>
                    <h4>Compara las Propuestas Presidenciales</h4>

                    <!-- formulario -->
                    <form id="form-2" class="form-inline col-xs-offset-2 col-xs-8 col-sm-12 col-md-offset-2 col-md-8"
                          method="POST" action="{{ url('frente-a-frente') }}">
                        {{ csrf_field() }}
                        <div class="form-group select">
                            <select id="frente_1" name="frente_1" class="form-control box-candidate classic">
                                <option>ESCOGE UN CANDIDATO</option>
                                @if(isset($objCandidato))
                                    @foreach($objCandidato as $candidato)
                                        <option value="{{ $candidato->id }}">{{ $candidato->nombre }} {{ $candidato->apellido }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group select">
                            <select id="frente_2" name="frente_2" class="form-control box-candidate classic">
                                <option>ESCOGE UN CANDIDATO</option>
                                @if(isset($objCandidato))
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


@stop
