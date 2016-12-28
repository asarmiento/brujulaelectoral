@if (Route::getCurrentRoute()->uri() == '/')
<header>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10">
          <h1><a href="{{ URL::to('/') }}"><span>BRÚJULA</span> ELECTORAL</a></h1>
          <div class="brand-logo"></div>
        </div>
        <div class="col-xs=12 col-sm-12 col-md-2" style="z-index: 9999">

          <div class="ico-social-media" style="margin-top: 30px;" >
            <div class="addthis_inline_share_toolbox"></div>
          </div>
        </div>
        <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                {{--
                <div id="main-menu" class="collapse navbar-collapse navbar-main-nav">
                  <ol id="menu-menu-principal" class="navbar-nav">
                    <li class=""><a title="Inicio" href="{{ URL::to('/') }}"><span>Inicia</span></a>
                    <p>QUÉ ESPERAR DEL SITIO</p></li>
                    <li class=""><a title="Inicio" href="{{ URL::to('juego-login') }}"><span>Juega</span></a>
                    <p>¿QUIÉN ES TU CANDIDATO AFIN?</p></li>
                    <li class=""><a title="Inicio" href="{{ URL::to('frente-a-frente') }}"><span>Compara</span></a>
                    <p>LAS PROPUESTAS PRESIDENCIALES</p></li>
                  </ol>
                </div>
                --}}
        </nav>
      </div>
    </div>    
  </header> 
@else
  <header>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
          <h2><a href="{{ URL::to('/') }}"><span>BRÚJULA</span> ELECTORAL</a></h2>
          <div class="brand-logo"></div>
        </div>
        <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <div id="main-menu" class="collapse navbar-collapse navbar-main-nav">
                  <ol id="menu-menu-principal" class="navbar-nav">
                    <li class=""><a title="Inicio" href="{{ URL::to('/') }}"><span>Inicia</span></a>
                    <p>QUÉ ESPERAR DEL SITIO</p></li>
                    <li class=""><a title="Inicio" href="{{ URL::to('juego-login') }}"><span>Juega</span></a>
                    <p>¿QUIÉN ES TU CANDIDATO AFIN?</p></li>
                    <li class=""><a title="Inicio" href="{{ URL::to('frente-a-frente') }}"><span>Compara</span></a>
                    <p>LAS PROPUESTAS PRESIDENCIALES</p></li>
              </ol>
            </div>
        </nav>
      </div>
    </div>    
  </header>
  @endif