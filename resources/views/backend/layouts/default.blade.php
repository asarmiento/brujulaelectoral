<!DOCTYPE html>
<html lang="es">
@include('backend.includes.head')
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('backend.includes.header')
    
            @include('backend.includes.navegacion')
            @yield('contenido')
    
        @include('backend.includes.footer')
        </div>
    </div>
    @include('backend.includes.scripts')
</body>
</html>