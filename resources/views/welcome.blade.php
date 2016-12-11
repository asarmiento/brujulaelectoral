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
