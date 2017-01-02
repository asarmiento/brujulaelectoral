
     <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/jquery.jrumble.1.3.min.js"></script>
    <script src="js/countdownTimer.js"></script>

    <script type="text/javascript">
    
    $(document).ready(function() {
        $('.btn-yes').click(function(e){
          e.preventDefault();
          $(".btn-yes").detach('slow').appendTo('.img-box')
          $('#respuesta').val("Si");
          $('#form-voto').submit();
        });
        $('.btn-no').click(function(e){
        	e.preventDefault();
          $(".btn-no").detach('slow').appendTo('.img-box')
          $('#respuesta').val("No");
          $('#form-voto').submit();
        });
        $('.btn-white').click(function(e){
        	e.preventDefault();
          $('.more-asw').show('slow');
          //$(".btn-white").detach('slow').appendTo('.img-box')
          //$('#respuesta').val("Blanco");
          //$('#form-voto').submit();
        });
        $('.op_1').click(function(e){
          e.preventDefault();
          $(".op_1").detach('slow').appendTo('.img-box')
          $('#respuesta').val($('.op_1').text());
          $('#form-voto').submit();
        });
        $('.op_2').click(function(e){
          e.preventDefault();
          $(".op_2").detach('slow').appendTo('.img-box')
          $('#respuesta').val($('.op_2').text());
          $('#form-voto').submit();
        });
        $('.op_3').click(function(e){
          e.preventDefault();
          $(".op_3").detach('slow').appendTo('.img-box')
          $('#respuesta').val($('.op_3').text());
          $('#form-voto').submit();
        });
        $('.op_4').click(function(e){
          e.preventDefault();
          $(".op_4").detach('slow').appendTo('.img-box')
          $('#respuesta').val($('.op_4').text());
          $('#form-voto').submit();
        });
        $('.op_5').click(function(e){
          e.preventDefault();
          $(".op_5").detach('slow').appendTo('.img-box')
          $('#respuesta').val($('.op_5').text());
          $('#form-voto').submit();
        });
        $('.btn-exit').click(function(){
          $(".more-asw").hide('slow');
        });
        
        

        $('#demo7').jrumble({
          speed: 200,
          x: 5,
          y: 5,
          rotation: 8
        });

        
        $('#demo7').trigger('startRumble');

        $('#demo7').hover(function(){
          $(this).trigger('stopRumble');
        }, function(){
          $(this).trigger('startRumble');
        }); 
        

        $('.pregunta').click(function(){
          $('.contpreguntas').hide();
          $('.pregunta').each(function(){
            
            if($(this).is(':checked')){
              $('.divpregunta'+$(this).val()).show();
            }
            
          });

        });

        $('.btnMostrarTodos').click(function(e){
          e.preventDefault();
          $('.contpreguntas').show();
          $('.pregunta').prop('checked',false)
          
        });
        $('input.tipoDownload').on('change', function() {
            $('input.tipoDownload').not(this).prop('checked', false);  
        });

    });


  </script>

  <script>
  /*
  $( function() {
    $( ".draggable" ).draggable();
    $( ".droppable" ).droppable({
      drop: function( event, ui ) {
        $( this )
          .addClass( "ui-state-highlight" )
          event.preventDefault();
          if(ui.draggable.attr("id") == "btn-yes"){
            $('#respuesta').val("Si");
          }else if(ui.draggable.attr("id") == "btn-no"){
            $('#respuesta').val("No");
          }else{
            $('#respuesta').val("Blanco");
          }
          $('#form-voto').submit();
          //.find( "a" ).val();
          //console.log(ui.draggable.attr("id"));
      }
    });
  } );*/
  </script>

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87995435-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5837a1ef16779b75"></script> 
