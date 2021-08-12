@extends('layouts.default')

@section('contenido')

    <section id="box-2-face">
        <div class="f2f-left"></div>
        <div class="f2f-right"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h2><span>Frente </span><span class="headline">a</span> Frente</h2>
                    <h4>Compara las Propuestas Presidenciales</h4>


                    <!-- formulario -->
                    <form id="form-2" class="form-inline col-xs-offset-2 col-xs-8 col-sm-12 col-md-offset-2 col-md-8"
                          method="POST" action="{{ url('frente-a-frente') }}">
                        {{ csrf_field() }}
                        <div class="form-group select">
                            <select id="frente_1" name="frente_1" class="form-control box-candidate classic">
                                <option>ESCOGE UN CANDIDATO</option>
                                @if(count([$objCandidato]))
                                    @foreach($objCandidato as $candidato)
                                        <option value="{{ $candidato->id }}">{{ $candidato->nombre }} {{ $candidato->apellido }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group select">
                            <select id="frente_2" name="frente_2" class="form-control box-candidate classic">
                                <option>ESCOGE UN CANDIDATO</option>
                                @if(count([$objCandidato]))
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
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p class="head-label">
                        Mostrar solo estas preguntas
                    </p>
                    <form id="check-face" method="POST" action="{{ url('frente-a-frente') }}">
                        {{ csrf_field() }}
                        @if(count([$objPreguntas]))
                            @foreach($objPreguntas as $pregunta)
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" name="pregunta"
                                           value="{{$pregunta->id}}" class="pregunta"> {{$pregunta->pregunta}}
                                </label>
                            @endforeach
                        @endif
                        <div style="clear: both;"></div>
                        <!--button type="submit" class="btn btn-main">Mostrar</button-->
                    </form>
                </div>
                <!-- tema -->
                @if($objCandidato1 and $objCandidato2)
                    @foreach($objPreguntas as $pregunta)
                        <?php
                        $objPartido1 = App\partido::whereId($objCandidato1->partidos_id)->first();
                        $objPartido2 = App\partido::whereId($objCandidato2->partidos_id)->first();
                        ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 face-group contpreguntas divpregunta{{$pregunta->id}}">

                            <h3>{{$pregunta->pregunta}}</h3>
                            <p class="txt-context">{{$pregunta->descripcion}}</p>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div>
                                    <div class="pic-box">
                                        <img src="{{ asset('imgJuego/'.$objCandidato1->foto) }}" class="foto126">
                                        <h4 class="box-2-face">{{$objCandidato1->nombre}} {{$objCandidato1->apellido}}
                                            <br> {{ $objPartido1->nombre }}</h4>
                                    </div>
                                    <?php
                                    $respuesta1 = App\candidatos_preguntas::where('candidatos_id', 'like', '%' . $objCandidato1->id . '%')->where('preguntas_id', 'like', '%' . $pregunta->id . '%')->first();
                                    if ($respuesta1) {
                                        $respuesta1 = $respuesta1->respuesta_ff;
                                    } else {
                                        $respuesta1 = "N/A";
                                    }
                                    $respuesta2 = App\candidatos_preguntas::where('candidatos_id', 'like', '%' . $objCandidato2->id . '%')->where('preguntas_id', 'like', '%' . $pregunta->id . '%')->first();
                                    if ($respuesta2) {
                                        $respuesta2 = $respuesta2->respuesta_ff;
                                    } else {
                                        $respuesta2 = "N/A";
                                    }
                                    $respuestaC1 = App\candidatos_preguntas::where('candidatos_id', 'like', '%' . $objCandidato1->id . '%')->where('preguntas_id', 'like', '%' . $pregunta->id . '%')->first();
                                    if ($respuestaC1) {
                                        $respuestaC1 = $respuestaC1->respuesta_ff;
                                    } else {
                                        $respuestaC1 = "N/A";
                                    }
                                    $respuestaC2 = App\candidatos_preguntas::where('candidatos_id', 'like', '%' . $objCandidato2->id . '%')->where('preguntas_id', 'like', '%' . $pregunta->id . '%')->first();
                                    if ($respuestaC2) {
                                        $respuestaC2 = $respuestaC2->respuesta_ff;
                                    } else {
                                        $respuestaC2 = "N/A";
                                    }
                                    ?>
                                    <p><strong>{{$respuestaC1}}</strong> | {{$respuesta1}}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div>
                                    <div class="pic-box">
                                        <img src="{{ asset('imgJuego/'.$objCandidato2->foto) }}" class="foto126">
                                        <h4 class="box-2-face">{{$objCandidato2->nombre}} {{$objCandidato2->apellido}}
                                            <br> {{ $objPartido2->nombre }}</h4>
                                    </div>

                                    <p><strong>{{$respuestaC2}}</strong> | {{$respuesta2}}</p>
                                </div>
                            </div>
                            <span class="ico-face"></span>

                        </div>
                    @endforeach
                @endif



                @if($objCandidato1 and $objCandidato2)
                <!-- propuestas -->
                    <div class="col-xs-12 col-sm-12 col-md-12 face-group face-group-propuestas">
                        <h3 class="headline-propuestas">Propuestas electorales</h3>
                        <!-- tema 1-->
                        <aside>
                            <h4>Seguridad</h4>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato1->binomio}}</span></h5>
                                {!!$objCandidato1->seguridad!!}
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato2->binomio}}</span></h5>
                                {!!$objCandidato2->seguridad!!}
                            </div>
                        </aside>

                        <!-- end tema -->
                        <!-- tema 2-->
                        <aside>
                            <h4>Empleo</h4>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato1->binomio}}</span></h5>
                                {!!$objCandidato1->empleo!!}
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato2->binomio}}</span></h5>
                                {!!$objCandidato2->empleo!!}
                            </div>
                        </aside>
                        <!-- end tema -->
                        <!-- tema 3-->
                        <aside>
                            <h4>Agricultura</h4>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato1->binomio}}</span></h5>
                                {!!$objCandidato1->agricultura!!}
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato2->binomio}}</span></h5>
                                {!!$objCandidato2->agricultura!!}
                            </div>
                        </aside>
                        <!-- tema 4-->
                        <aside>
                            <h4>Educación</h4>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato1->binomio}}</span></h5>
                                {!!$objCandidato1->educacion!!}
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato2->binomio}}</span></h5>
                                {!!$objCandidato2->educacion!!}
                            </div>
                        </aside>
                        <!-- tema 5-->
                        <aside>
                            <h4>Salud</h4>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato1->binomio}}</span></h5>
                                {!!$objCandidato1->salud!!}
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato2->binomio}}</span></h5>
                                {!!$objCandidato2->salud!!}
                            </div>
                        </aside>
                        <!-- tema 6-->
                        <aside>
                            <h4>Democracia</h4>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato1->binomio}}</span></h5>
                                {!!$objCandidato1->democracia!!}
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato2->binomio}}</span></h5>
                                {!!$objCandidato2->democracia!!}
                            </div>
                        </aside>
                        <!-- tema 7-->
                        <aside>
                            <h4>Economía</h4>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato1->binomio}}</span></h5>
                                {!!$objCandidato1->economia!!}
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato2->binomio}}</span></h5>
                                {!!$objCandidato2->economia!!}
                            </div>
                        </aside>
                        <!-- tema 8-->
                        <aside>
                            <h4>Ambiente</h4>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato1->binomio}}</span></h5>
                                {!!$objCandidato1->ambiente!!}
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <h5 class="box-binomio">Binomio: <span>{{$objCandidato2->binomio}}</span></h5>
                                {!!$objCandidato2->ambiente!!}
                            </div>
                        </aside>


                        <!-- end tema -->
                        <span class="ico-face"></span>
                    </div>
                    <!-- end propuestas -->

                @endif


                <div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-4">
                    <a href="#" class="btn btn-main btnMostrarTodos">Mostrar todas</a>
                </div>


            </div>
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
