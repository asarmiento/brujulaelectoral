<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/backend/') }}" class="site_title"><span>Brújula Electoral</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <i class="fa fa-user img-circle profile_img" style="font-size: 45px;text-align: center;"></i>
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>Administrador</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ URL::to('backend/') }}"><i class="fa fa-cog"></i> Backend </a>
                  </li>
                  <li><a href="{{ URL::to('backend/partidos') }}"><i class="fa fa-hand-o-up"></i> Partidos Políticos </a></li>
                  <li><a href="{{ URL::to('backend/candidatos') }}"><i class="fa fa-male"></i> Candidatos presidenciales </a></li>
                  <li><a href="{{ URL::to('backend/preguntas') }}"><i class="fa fa-question"></i> Preguntas </a></li>
                  <li><a href="{{ URL::to('backend/respuestas') }}"><i class="fa fa fa-list"></i> Respuestas de Candidato </a></li>
                  <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Ir sitio Web </a>
                  </li>
                  
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            
          </div>
        </div>