@extends('layouts.default')

@section('contenido')
    
    @if(!session()->has('participante'))
        <?php 
          return redirect('juego-login')->with('error_msj','Ingrese sus datos para participar');
          //{{ session('participante') }}
        ?>
    @endif

    <?php $blanco = '' ?>

<section id="box-game">
		<div class="container">
			<div class="row">
			<!-- titulo -->
				<div class="col-xs-12 col-sm-12 col-md-offset-3 col-md-6">
					<h2><span>¿Quién es tu </span>Candidato afín?</h2>
					<h4></h4>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">

				</div>
				<!-- juego -->
				<div class="col-xs-12 col-sm-12 col-md-12 box-answer">
					<h3 class="headline-3">
					@if($objPregunta)
						{{$objPregunta->pregunta}}
					@endif
					</h3>

					<div class="box-middle">
						<h4>Candidatos afines:</h4>
						<ul class="closer-match">
						@if(count($objRespuestas))
							@foreach($objRespuestas as $respuesta)
								<!-- Valido si existe respuesta  -->
								
									@if($respuesta->pivot->opcion == $objMiRespuesta->pivot->respuesta)
										<li class="match-candidate">
											<img src="{{ asset('imgJuego/'.$respuesta->foto) }}" class="foto70">
										</li>
									@elseif($respuesta->pivot->respuesta_corta == substr($objMiRespuesta->pivot->respuesta,0,3))
										<li class="match-candidate">
											<img src="{{ asset('imgJuego/'.$respuesta->foto) }}" class="foto70">
										</li>
									@endif

							@endforeach
						@endif
						</ul>
					</div>
					
				</div>
				<div id="answer-content" class="col-xs-12 col-sm-12 col-md-12">
					<h3 class="info-question">
						Respuestas
					</h3>

					<ul id="candidate-answer">
					@if(count($objRespuestas))
						@foreach($objRespuestas as $respuesta)
							 <?php 
							 	if($respuesta->pivot->respuesta_corta == 'Sí'){
							 		$estiloBtn = "yes";
							 	}elseif($respuesta->pivot->respuesta_corta == 'No'){
							 		$estiloBtn = "no";
							 	}else{
							 		$estiloBtn = "white";
							 	}
							 ?>
							@if($respuesta->pivot->respuesta_corta == 'Blanco')
							<?php 
								$blanco .=  '<li><span class="btn-'.$estiloBtn.'">'.$respuesta->pivot->respuesta_corta.'</span><img src="imgJuego/'.$respuesta->foto.'" class="foto126"><div class="text"><h4>'.$respuesta->nombre.' '.$respuesta->apellido.'</h4><p>'.$respuesta->pivot->respuesta_larga.'</p></div></li>';
							?>
							@else
								<li>
									<span class="btn-{{$estiloBtn}}">{{ $respuesta->pivot->respuesta_corta }}</span>
									<img src="{{ asset('imgJuego/'.$respuesta->foto) }}" class="foto126">
									<div class="text">
										<h4>{{ $respuesta->nombre }} {{ $respuesta->apellido }}</h4>
										<p>{{ $respuesta->pivot->respuesta_larga }}</p>
									</div>
								</li>
							@endif
							
						@endforeach
						<?php echo $blanco; ?>
					@endif
					</ul>
					<div>
					@if( count($objPreguntasTodas) == $objPregunta->id)
						<a href="{{ url('juego') }}" class="btn btn-main btn-result">Mira el resultado</a>
					@else
						<a href="{{ url('juego') }}" class="btn btn-main btn-result">Siguiente</a>
					@endif
						<p class="share">COMPARTIR: <span class="addthis_inline_share_toolbox"></span></p>
					</div>
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
					<form id="form-2" class="form-inline col-xs-offset-2 col-xs-8 col-sm-12 col-md-offset-2 col-md-8">
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