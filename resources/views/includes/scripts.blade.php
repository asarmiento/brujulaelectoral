
     <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script type="text/javascript">
    
    $(document).ready(function() {
        $('.btn-yes').click(function(e){
        	e.preventDefault();
          $('#respuesta').val("Si");
          $('#form-voto').submit();
        });
        $('.btn-no').click(function(e){
        	e.preventDefault();
          $('#respuesta').val("No");
          $('#form-voto').submit();
        });
        $('.btn-white').click(function(e){
        	e.preventDefault();
          $('#respuesta').val("Blanco");
          $('#form-voto').submit();
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
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87995435-1', 'auto');
  ga('send', 'pageview');

</script>
