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
				<div class="col-xs-12 col-sm-12 col-md-3 box-answer">
					<h4>Candidatos afines:</h4>
					
					<?php
					$i=1;
					foreach ($arrayResultado as $key => $value) {
		            	$nomCandidato = explode(' ', $key);
		            	$objCandidatoPregunta = App\candidatos::where('nombre','=',$nomCandidato[0])->where('apellido','=',$nomCandidato[1])->first();
		            	if($i==1){
					?>
						<ul class="closer-match">
							<li class="match-candidate">
								<img src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" class="foto70">
							</li>
						</ul>
					<?php }
					if($i == 2){
					?>
						<ul class="middle-match">
							<li class="match-candidate">
								<img src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" class="foto55">
							</li>
						</ul>
					<?php } $i++;
					} ?>
					
					
				</div>
				<div id="answer-content" class="col-xs-12 col-sm-12 col-md-9">
					<h3 class="info-question">
						Resultados del juego
					</h3>
					<!--barra 1 -->
					<br>

				<?php

		            foreach ($arrayResultado as $key => $value) {
		            	$nomCandidato = explode(' ', $key);
		            	$objCandidatoPregunta = App\candidatos::where('nombre','=',$nomCandidato[0])->where('apellido','=',$nomCandidato[1])->first();
                ?>
		                <div>
						<p class="box-name col-xs-12 col-sm-3 col-md-2">{{$key}}</p>
						<div class="col-xs-12 col-sm-9 col-md-10">
							<div class="progress">
								<img class="box-pic foto126" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}">
				
								<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $value }}%;">
    								{{ $value }}%
  								</div>
							</div>
						</div>
					</div>

				<?php
		            }

				?>					
					
					<!--a href="#" class="btn btn-main">Juega otra vez</a-->
					<a href="{{ URL::to('/') }}" class="btn btn-main">Ver Estadísticas</a>
					<p class="share">COMPARTIR:</p>

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
@stop