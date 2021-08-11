@extends('backend.layouts.default')

@section('contenido')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">{{count($objParticipantes)}}</div>
                  <h3>Participantes</h3>
                  <p>que responden todas las preguntas.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">{{count([$objPreguntas])}}</div>
                  <h3>Preguntas</h3>
                  <p>Preguntas activas ingresas en el sistema.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">{{count($objNoParticipantes)}}</div>
                  <h3>Participantes</h3>
                  <p>que no responden todas las preguntas.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">{{count($objCandidatos)}}</div>
                  <h3>Candidatos</h3>
                  <p>Candidatos ingresados en el sistema.</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Más afin <small>todo</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @if($arrayResultado)
                    @foreach($arrayResultado as $clave => $fila)
                    <?php
                    $nomCandidato = explode(' ', $fila['candidatos']);
                    $objCandidatoPregunta = App\candidatos::where('nombre','like','%'.$nomCandidato[0].'%')->where('apellido','like', '%'.$nomCandidato[1].'%')->first();
                    ?>
                    <article class="media event">
                      <a class="pull-left ">
                        <img class="box-pic foto70" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" >
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$fila['candidatos']}}</a>
                        <p>{{number_format($fila['porcentaje'],2)}}%</p>
                      </div>
                    </article>
                    @endforeach
                    @endif
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Femenino <small>afin</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if($arrayFemenino)
                    @foreach($arrayFemenino as $clave => $fila)
                    <?php
                    $nomCandidato = explode(' ', $fila['candidatos']);
                    $objCandidatoPregunta = App\candidatos::where('nombre','like','%'.$nomCandidato[0].'%')->where('apellido','like', '%'.$nomCandidato[1].'%')->first();
                    ?>
                    <article class="media event">
                      <a class="pull-left ">
                        <img class="box-pic foto70" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" >
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$fila['candidatos']}}</a>
                        <p>{{number_format($fila['porcentaje'],2)}}%</p>
                      </div>
                    </article>
                    @endforeach
                    @endif
                  </div>
                </div>
              </div>

               <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Masculino <small>afin</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if($arrayMasculino)
                    @foreach($arrayMasculino as $clave => $fila)
                    <?php
                    $nomCandidato = explode(' ', $fila['candidatos']);
                    $objCandidatoPregunta = App\candidatos::where('nombre','like','%'.$nomCandidato[0].'%')->where('apellido','like', '%'.$nomCandidato[1].'%')->first();
                    ?>
                    <article class="media event">
                      <a class="pull-left ">
                        <img class="box-pic foto70" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" >
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$fila['candidatos']}}</a>
                        <p>{{number_format($fila['porcentaje'],2)}}%</p>
                      </div>
                    </article>
                    @endforeach
                    @endif

                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>GLTB <small>afin</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if($arrayGLTB)
                    @foreach($arrayGLTB as $clave => $fila)
                    <?php
                    $nomCandidato = explode(' ', $fila['candidatos']);
                    $objCandidatoPregunta = App\candidatos::where('nombre','like','%'.$nomCandidato[0].'%')->where('apellido','like', '%'.$nomCandidato[1].'%')->first();
                    ?>
                    <article class="media event">
                      <a class="pull-left ">
                        <img class="box-pic foto70" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" >
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$fila['candidatos']}}</a>
                        <p>{{number_format($fila['porcentaje'],2)}}%</p>
                      </div>
                    </article>
                    @endforeach
                    @endif

                  </div>
                </div>
              </div>

               <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edad 16 - 25 <small>afin</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if($array1625)
                    @foreach($array1625 as $clave => $fila)
                    <?php
                    $nomCandidato = explode(' ', $fila['candidatos']);
                    $objCandidatoPregunta = App\candidatos::where('nombre','like','%'.$nomCandidato[0].'%')->where('apellido','like', '%'.$nomCandidato[1].'%')->first();
                    ?>
                    <article class="media event">
                      <a class="pull-left ">
                        <img class="box-pic foto70" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" >
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$fila['candidatos']}}</a>
                        <p>{{number_format($fila['porcentaje'],2)}}%</p>
                      </div>
                    </article>
                    @endforeach
                    @endif

                  </div>
                </div>
              </div>

               <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edad 25 - 35 <small>afin</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if($array2535)
                    @foreach($array2535 as $clave => $fila)
                    <?php
                    $nomCandidato = explode(' ', $fila['candidatos']);
                    $objCandidatoPregunta = App\candidatos::where('nombre','like','%'.$nomCandidato[0].'%')->where('apellido','like', '%'.$nomCandidato[1].'%')->first();
                    ?>
                    <article class="media event">
                      <a class="pull-left ">
                        <img class="box-pic foto70" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" >
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$fila['candidatos']}}</a>
                        <p>{{number_format($fila['porcentaje'],2)}}%</p>
                      </div>
                    </article>
                    @endforeach
                    @endif

                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edad 35 - 45 <small>afin</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if($array3545)
                    @foreach($array3545 as $clave => $fila)
                    <?php
                    $nomCandidato = explode(' ', $fila['candidatos']);
                    $objCandidatoPregunta = App\candidatos::where('nombre','like','%'.$nomCandidato[0].'%')->where('apellido','like', '%'.$nomCandidato[1].'%')->first();
                    ?>
                    <article class="media event">
                      <a class="pull-left ">
                        <img class="box-pic foto70" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" >
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$fila['candidatos']}}</a>
                        <p>{{number_format($fila['porcentaje'],2)}}%</p>
                      </div>
                    </article>
                    @endforeach
                    @endif

                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edad 45 en adelante <small>afin</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if($array45)
                    @foreach($array45 as $clave => $fila)
                    <?php
                    $nomCandidato = explode(' ', $fila['candidatos']);
                    $objCandidatoPregunta = App\candidatos::where('nombre','like','%'.$nomCandidato[0].'%')->where('apellido','like', '%'.$nomCandidato[1].'%')->first();
                    ?>
                    <article class="media event">
                      <a class="pull-left ">
                        <img class="box-pic foto70" src="{{ asset('imgJuego/'.$objCandidatoPregunta->foto) }}" >
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">{{$fila['candidatos']}}</a>
                        <p>{{number_format($fila['porcentaje'],2)}}%</p>
                      </div>
                    </article>
                    @endforeach
                    @endif

                  </div>
                </div>
              </div>




            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Reporte de respuestas por pregunta <small>consolidado</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @foreach($objPreguntas as $pregunta)
                    <strong><br><br>{{$pregunta->id .'. '. $pregunta->pregunta}}</strong>
                    <?php $objRespuesta = App\participantes_preguntas::reportes($pregunta->id);
                      foreach($objRespuesta as $p){
                        echo '<br>'. $p->counta . ' -> ' . $p->respuesta ;
                      }
                    ?>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection
