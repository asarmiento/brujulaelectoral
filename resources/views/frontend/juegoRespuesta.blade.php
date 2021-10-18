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

				<div class="col-xs-12 col-sm-12 col-md-12">

				</div>
				
				
				<div class="col-xs-2 col-sm-2 col-md-3">
                    <p class="txt-question">Pregunta</p>
                    <div class="number">
                      @if(isset($objPreguntaAct))
                        {{ $objPreguntaAct->id  }}.
                        @endif
                    </div>
                </div>

				<!-- juego -->
				<div class="col-xs-12 col-sm-12 col-md-12 box-answer">
					<h3 class="headline-3">
					@if($objPregunta)
						{{$objPregunta->pregunta}}
					@endif
					</h3>

					<div>
						<a href="{{ route('viewJuego') }}" class="btn btn-main btn-result">Siguiente Pregunta</a>
					</div>
				</div>
				
				
				
				
				
				
				
		<div id="answer-content-iqual" class="col-xs-12 col-sm-12 col-md-12">
				<h3 class="info-question">
					Presidenciables con la misma respuesta:
				</h3>
			<ul id="candidate-answer">
				<?php $nan = 0; ?>
						@if(count([$objRespuestas]))
							<ul class="closer-match">
							@foreach($objRespuestas as $respuesta)
								<!-- Valido si existe respuesta  -->
									@if($respuesta->pivot->respuesta_corta == $objMiRespuesta->pivot->respuesta)
										<li class="match-candidate">
											<img src="{{ asset('imgJuego/'.$respuesta->foto) }}" class="foto120">
											<h4 style="color: black">{{ $respuesta->nombre }} {{ $respuesta->apellido }}</h4>
										</li>
										<?php $nan++; ?>
									@elseif($respuesta->pivot->opcion == $objMiRespuesta->pivot->respuesta)
											<li class="match-candidate">
												<img src="{{ asset('imgJuego/'.$respuesta->foto) }}" class="foto70">
												<h4 style="color: black; background-color: white">{{ $respuesta->nombre }} {{ $respuesta->apellido }}</h4>
											</li>
											<?php $nan++; ?>
									@endif
							@endforeach
							</ul>
						@endif
						@if($nan==0)

							<h4 ><strong>Ninguna afinidad con candidatos</strong></h4>
						@endif
			</ul>		
		</div>		
				
				
				
				
				
				
				
				<div id="answer-content" class="col-xs-12 col-sm-12 col-md-12">
					<h3 class="info-question">
						Respuesta de todos los candidatos
					</h3>
					<ul id="candidate-answer">
					@if(isset($objRespuestas))
						@foreach($objRespuestas as $respuesta)
							 <?php
							 	if($respuesta->pivot->respuesta_corta == 'A favor'){
							 		$estiloBtn = "yes";
							 	}elseif($respuesta->pivot->respuesta_corta == 'En contra'){
							 		$estiloBtn = "no";
							 	}elseif($respuesta->pivot->respuesta_corta == 'Neutro'){
							 		$estiloBtn = "white";
							 	}else{
							 		$estiloBtn = "white";
							 	}
							 ?>
							@if($respuesta->pivot->respuesta_corta == 'Neutro')
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
				    <h4>También tenemos</h4>
					<h2><span>Cara </span><span class="headline">a</span> Cara</h2>
					<h4>Compara las Propuestas Presidenciales</h4>



					<!-- formulario -->
					<form id="form-2" class="form-inline col-xs-offset-2 col-xs-8 col-sm-12 col-md-offset-2 col-md-8">
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
			</div>
		</div>

	</section>

@stop
