@extends('layouts.default')

@section('contenido')
    
    <section id="box-text">
    <div class="row">
    <div class="container">

      <!-- titulo -->
        <div class="col-xs-offset-0 col-sm-offset-0 col-xs-12 col-sm-12 col-md-offset-2 col-md-7">
          <h2>El recorrido periodístico y el desarrollo tecnológico de la Brújula Electoral</h2>
          <h4>¿Qué es Brújula Electoral?</h4>
          <p>Brújula Electoral es un proyecto conjunto entre la revista digital Plan V y la Fundación Ciudadanía y Desarrollo (FCD) para que los electores, sobre todo los jóvenes, encuentren al candidato presidencial que más se acerque a sus aspiraciones y creencias. No es la primera experiencia en la región. En <a href="http://www.yoquierosaber.org/" target="_blank"><strong>Argentina</strong></a>, <a href="http://www.votainteligente.cl/" target="_blank"><strong>Chile</strong></a>, <a href="http://elmenospeor.com/" target="_blank"><strong>México</strong></a> y más países se ha desarrollado portales de este tipo con el objetivo de mostrar una fotografía, rápida e interactiva, de los planteamientos de los candidatos en relación a lo que espera la gente. 
          </p>
          <p>
          Para determinar cuáles son los temas que interesan se hicieron grupos focales con jóvenes entre 20 y 30 años. De ellos, el equipo recibió un total de 25 preguntas sobre sus principales preocupaciones respecto al nuevo Gobierno. Este bloque de preguntas planteó inquietudes sobre siete temas: educación, economía, los poderes del Estado, leyes, derechos políticos, derechos sexuales y corrupción. Después de una selección final, por parte del equipo periodístico, quedó un cuestionario de 10 preguntas para los ocho candidatos presidenciales. Pero solo siete aspirantes respondieron las preguntas.  
          </p>
          <h4>¿Por qué no está Lenín Moreno?</h4>
          <p>Plan V solicitó entrevistas con los ocho candidatos presidenciales. Los candidatos Cynthia Viteri, Guillermo Lasso, Paco Moncayo, Washington Pesántez, Patricio Zuquilanda, Iván Espinel y Dalo Bucaram respondieron el cuestionario en entrevistas personales o por correo electrónico. Pero no hubo respuesta por parte del equipo del postulante oficialista Lenín Moreno. Plan V insistió en este pedido por correos, llamadas y mensajes a Andrés Michelena, asesor de comunicación del candidato, sin que hasta el momento haya una respuesta siquiera</p>
          <img class="img-mail" src="{{asset('images/correo2.png)}}">
          <h4>¿Cómo funciona la Brújula Electoral?</h4>
          <p>Cada usuario tiene la oportunidad de votar sí o no en cada una de las 10 preguntas del cuestionario. En algunas aparece un botón adicional llamado “Más opciones”. Allí los usuarios pueden afinar más su voto y dar uno a aquella propuesta que le parece mejor. Por ejemplo, en la pregunta “¿Está de acuerdo con derogar la Ley de Comunicación?”,  hay las siguientes opciones adicionales: </p>
          <ul>
            <li>No, pero será reformada.</li>
            <li>Sí, pero conservaría el derecho a la réplica en una nueva ley.</li>
            <li>Sí, pero se elaboraría nueva ley.</li>
            <li>Sí, pero se sometería a consulta popular. 
          </li>
          </ul>
          <p>Estas opciones salen de las mismas respuestas de los candidatos. El portal hace un cómputo final sobre cuántas coincidencias tuvo el usuario o no con los aspirantes presidenciables y así establece su candidato más afín. Esta funcionalidad es la siguiente: </p>
          <ol class="lista-numeros">
            <li>Si el usuario vota solo sí o solo no, se da un punto a todos los candidatos que hayan dicho sí o no, sin distinción. </li>
            <li>Pero si el usuario pulsa en Más opciones y escoge una de ellas, ese voto va para el candidato/s que hayan planteado esa propuesta específica. </li>
          </ol>
          <h4>¿Cómo se establece el ranking del candidato más afín? </h4>
          <p>En la página principal del sitio se encuentra el ranking del “Candidato más compatible”, que se establece según las participaciones en este portal. Solo se toma en cuenta aquellas participaciones que completaron las 10 preguntas. Después el algoritmo hace el siguiente cálculo: </p>
          <ol class="lista-numeros">
            <li>Primero calcula el total de participaciones en el sitio. Esta cifra es la multiplicación del número de participantes por el número de preguntas. Si hay 2 participantes y son 10 preguntas, el número total de participaciones son 20.</li>
            <li>Después establece el número de coincidencias que tiene cada candidato con los usuarios y esta cifra se divide para el total de participaciones. Siguiendo el ejemplo anterior, si con el candidato A coinciden 10 de las 20 participaciones, este candidato alcanza una afinidad del 50%. 
          </li>
          </ol>
          <p>El usuario además de ver los resultados globales puede filtrar por género y edad. Inclusive puede descargar los resultados en formato excel o CSV y hacer sus propios análisis.  </p>
          <h4>¿Qué es el Frente a Frente?</h4>
          <p>En esta sección, el usuario puede confrontar las posiciones de los candidatos por cada una de las 10 preguntas. Además allí se encuentran las respuestas ampliadas de cada uno de los aspirantes. </p>
          <h4>Creative Commons</h4>
          <p>Finalmente este portal tiene licencia de Creative Commons. El código es abierto y está disponible para que cualquier otra organización lo ajuste a sus necesidades. El código estará disponible próximamente en GitHub. 
          </p>
                  </div>
      </div>
    </div>
  </section>

<section id="box-game">
    <div class="container">
      <div class="row">
        <div class="col-xs=12 col-sm-12 col-md-6">
          <h2><span>¿Quién es tu </span>Candidato afín?</h2>
          <h4></h4>
          <div class="col-xs-12 col-sm-12 col-md-12">
                      Después de grupos focales con jóvenes de entre 20 y 30 años, la revista digital Plan V, con el apoyo de la Fundación Ciudadanía y Desarrollo, desarrolló este portal para que los electores, sobre todo los jóvenes, encuentren al candidato presidencial que más se acerque a sus aspiraciones y creencias. Solo 7 de los 8 candidatos contestaron el cuestionario. Pese a reiterados pedidos, el oficialista Lenín Moreno no accedió a la entrevista y por eso sus respuestas aparecen en blanco. No olvides hacer clic en <i>Opciones</i> para afinar más tu voto. <br>¿Coincides con ellos?
                    </div>
                    <a href="{{URL::to('juego-login')}}" class="btn btn-main">Juega y Averígualo</a>
                    <div class="quiz-game"></div>
        </div>
      </div>
    </div>
  </section>

  
  @stop