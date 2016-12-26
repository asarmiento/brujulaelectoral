@extends('layouts.default')

@section('contenido')
    <div class="container">
      <div class="row ">
        <div id="countdown-box" class="col-xs-12 col-sm-12 col-md-12 ">
          <h4>Espéranos en:</h4>
          <center id="countdown" >
          <div>
            <p class="days colorDefinition size_lg">00</p>
            <span class="timeRefDays displayformat">Días</span>
          </div>
          <div>
            <p class="hours colorDefinition size_lg">00</p>
            <span class="timeRefHours displayformat">horas</span>
          </div>
          <div>
            <p class="minutes colorDefinition size_lg">00</p>
            <span class="timeRefMinutes displayformat">minutos</span>
          </div>
          <div>
            <p class="seconds colorDefinition size_lg">00</p>
            <span class="timeRefSeconds displayformat">segundos</span>
          </div>  
            
          </center>    
          
        </div>
      </div>
    </div>
@endsection
