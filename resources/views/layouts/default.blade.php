<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
@include('includes.head')
@if (Route::getCurrentRoute()->uri() == '/')
	<body>
@else
	<body id="interna">
@endif

        @include('includes.header')
    
            
            @yield('contenido')
    
        @include('includes.footer')

    @include('includes.scripts')
</body>
</html>