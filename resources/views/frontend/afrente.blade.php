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
				<div class="col-xs-12 col-sm-12 col-md-12">
					<p class="head-label">
						Mostrar solo estas preguntas
					</p>
					<form id="check-face" method="POST" action="{{ url('frente-a-frente') }}">
					{{ csrf_field() }}
						@if(count($objPreguntas))
							@foreach($objPreguntas as $pregunta)
								<label class="checkbox-inline">
			  						<input type="checkbox" id="inlineCheckbox1" name="pregunta" value="{{$pregunta->id}}" class="pregunta"> {{$pregunta->pregunta}}
								</label>
							@endforeach
						@endif
						<div style="clear: both;"></div>
						<!--button type="submit" class="btn btn-main">Mostrar</button-->
					</form>
				</div>
				<!-- tema -->
				@if(count($objCandidato1) and count($objCandidato2))
					@foreach($objPreguntas as $pregunta)
						<?php
							$objPartido1 = App\partido::whereId($objCandidato1->partidos_id)->first();
							$objPartido2 = App\partido::whereId($objCandidato2->partidos_id)->first();
						?>
				<div class="col-xs-12 col-sm-12 col-md-12 face-group contpreguntas divpregunta{{$pregunta->id}}">
				
					<h3 >{{$pregunta->pregunta}}</h3>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div>
							<div class="pic-box">
								
								<h4 class="box-2-face">{{$objCandidato1->nombre}} {{$objCandidato1->apellido}}<br> {{ $objPartido1->nombre }}</h4>	
							</div>
							<?php
								$respuesta1 = App\candidatos_preguntas::where('candidatos_id','=',$objCandidato1->id)->where('preguntas_id','=',$pregunta->id)->first()->respuesta_larga;
								$respuesta2 = App\candidatos_preguntas::where('candidatos_id','=',$objCandidato2->id)->where('preguntas_id','=',$pregunta->id)->first()->respuesta_larga;

								$respuestaC1 = App\candidatos_preguntas::where('candidatos_id','=',$objCandidato1->id)->where('preguntas_id','=',$pregunta->id)->first()->respuesta_corta;
								$respuestaC2 = App\candidatos_preguntas::where('candidatos_id','=',$objCandidato2->id)->where('preguntas_id','=',$pregunta->id)->first()->respuesta_corta;
							?>
							<p><strong>{{$respuestaC1}}</strong> | {{$respuesta1}}</p>		
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div>
							<div class="pic-box">
								
								<h4 class="box-2-face">{{$objCandidato2->nombre}} {{$objCandidato2->apellido}}<br> {{ $objPartido2->nombre }}</h4>	
							</div>

							<p><strong>{{$respuestaC2}}</strong> | {{$respuesta2}}</p>		
						</div>
					</div>
					<span class="ico-face"></span>
				
				</div>
				@endforeach
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
					<h2><span>¿Quién es tu </span>Candidato afin?</h2>
					<h4>Juego Electoral</h4>
					<div class="col-xs=12 col-sm-12 col-md-6">Después de grupos focales con jóvenes de entre 20 y 26 años, el equipo periodístico de la revista digital Plan V, con el apoyo de la Fundación Ciudadanía y Desarrollo, desarrolló este portal para que los electores, sobre todo los jóvenes, encuentren al candidato presidencial que más se acerque a sus aspiraciones y creencias. </div>
                    <div class="col-xs=12 col-sm-12 col-md-6">Desde economía hasta libertades sexuales, esto fue lo respondieron los presidenciales a las 10 inquietudes que tiene este sector sobre el futuro del país. ¿Coincides con ellos?
</div>
                    <a href="{{URL::to('juego-login')}}" class="btn btn-main">Juega y Averígualo</a>
                    <div class="quiz-game"></div>
				</div>
			</div>
		</div>
	</section>
	@endsection
