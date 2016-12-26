@extends('layouts.default')

@section('contenido')
    
    @if(!session()->has('participante'))
        <?php 
          return redirect('juego-login')->with('error_msj','Ingrese sus datos para participar');
          //{{ session('participante') }}
        ?>
    @endif

  <section id="box-game">
    <div class="container">
      <div class="row">
      <!-- titulo -->
        <div class="col-xs=12 col-sm-12 col-md-offset-3 col-md-6">
          <h2><span>¿Quién es tu </span>Candidato afin?</h2>
          <h4>Juego Electoral</h4>
        </div>
        <div class="col-xs=12 col-sm-12 col-md-12">

        </div>
        <!-- juego -->
        <div class="col-xs-2 col-sm-2 col-md-3">
          <p class="txt-question">Pregunta</p>
          <div class="number">
            {{ $objPreguntaAct->id  }}.
          </div>
        </div>
        <div class="col-xs=10 col-sm-6 col-md-5">
          
          @if(count($objPreguntaAct))
            <h3 class="headline-3">{{ $objPreguntaAct->pregunta }}</h3>
            <p class="txt-context-2">{{ $objPreguntaAct->descripcion }}</p>
          @endif
          
          <p class="info-question"><span>{{ $objPreguntaAct->id  }}</span> /{{ count($objPreguntas) }} preguntas</p>
          <p></p>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 ">
          <form id="form-voto" class="form-horizontal col-xs-12 col-sm-12  col-md-12" method="POST" action="{{ url('juego') }}" >
          {{ csrf_field() }}
            <a class="btn-yes draggable" href="" id="btn-yes">SI</a>
            <a class="btn-no draggable" href="" id="btn-no">NO</a>
            <a class="btn-white draggable" href="" id="btn-white">BLANCO</a>
            <div class="more-asw" style="display: none;">
              <p><a class="op_si_1">{{ $objPreguntaAct->opcion_si_1 }}</a></p>
              <p><a class="op_si_2">{{ $objPreguntaAct->opcion_si_2 }}</a></p>
              <p><a class="op_no_1">{{ $objPreguntaAct->opcion_no_1 }}</a></p>
              <p><a class="op_no_2">{{ $objPreguntaAct->opcion_no_2 }}</a></p>
            </div>
            <input type="hidden" name="respuesta" id="respuesta" value="">
           
              <input type="hidden" name="pregunta" id="pregunta" value="{{ $objPreguntaAct->id }}">
          </form>
          <div style="clear: both;"></div>
          <div class="img-box droppable " id="demo7"></div>
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
          <form id="form-2" class="form-inline col-xs-offset-2 col-xs-8 col-sm-12 col-md-offset-2 col-md-8" method="POST" action="{{ url('frente-a-frente') }}" >
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

  
  @stop