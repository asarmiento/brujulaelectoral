<!-- Extendemos de la plantila por defecto creada -->
@extends('backend.layouts.default')

@section('contenido')

<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Dashboard</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-12 col-md-12">
                    <h2>Cuponcity.ec</h2>
                    <p>Bienvenido(a) {{ Auth::user()->nombre }} a continuacion un pequeño resumen de lo nuevo en Cuponcity.ec</p>
                </div>
            </div>

        </div>
    </div>
</div>
            
<div class=" row">
    @if (Session::has('mensajeServer'))
        {{ Session::get('mensajeServer') }}
    @endif
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="Transacciones" class="well top-block" href="{{ URL::to('backend/reportes/cuponesVendidos') }}">
            <i class="glyphicon glyphicon-eye-open blue"></i>
            <div>Transacciones</div>
            <div>{{ $cantidadTransacciones }}</div>
        	<span class="notification">{{ $cantidadTransaccionesNuevos }}</span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        @if(Usuario::verificaPermiso('backend/suscriptores/listaSuscriptores'))
            <a data-toggle="tooltip" title="Suscriptores" class="well top-block" href="{{ URL::to('backend/suscriptores/listaSuscriptores') }}">
                <i class="glyphicon glyphicon-map-marker yellow"></i>
                <div>Suscriptores</div>
                <div>{{ $cantidadSuscriptores }}</div>
                <span class="notification yellow">{{ $cantidadSuscriptoresNuevos }}</span>
            </a>
        @else
            <a data-toggle="tooltip" title="Suscriptores" class="well top-block">
                <i class="glyphicon glyphicon-map-marker yellow"></i>
                <div>Suscriptores</div>
                <div>0</div>
                <span class="notification yellow">0</span>
            </a>
        @endif
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        @if(Usuario::verificaPermiso('backend/establecimientos/listaEstablecimientos'))
            <a data-toggle="tooltip" title="Establecimientos" class="well top-block" href="{{ URL::to('backend/establecimientos/listaEstablecimientos') }}">
                <i class="glyphicon glyphicon-briefcase green"></i>
                <div>Establecimientos</div>
                <div>{{ $cantidadEstablecimientos }}</div>
                <span class="notification green">{{ $cantidadEstablecimientosNuevos }}</span>
            </a>
        @else
            <a data-toggle="tooltip" title="Establecimientos" class="well top-block">
                <i class="glyphicon glyphicon-briefcase green"></i>
                <div>Establecimientos</div>
                <div>0</div>
                <span class="notification green">0</span>
            </a>
        @endif
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        @if(Usuario::verificaPermiso('backend/ofertas/listaOfertas'))
            <a data-toggle="tooltip" title="Ofertas" class="well top-block" href="{{ URL::to('backend/ofertas/listaOfertas') }}">
                <i class="glyphicon glyphicon-envelope red"></i>
                <div>Ofertas</div>
                <div>{{ $cantidadOfertas }}</div>
                <span class="notification red">{{ $cantidadOfertasNuevas }}</span>
            </a>
        @else
            <a data-toggle="tooltip" title="Ofertas" class="well top-block">
                <i class="glyphicon glyphicon-envelope red"></i>
                <div>Ofertas</div>
                <div>0</div>
                <span class="notification red">0</span>
            </a>
        @endif
    </div>
</div>

<div class="row">
	<div class="box col-md-12">
		<div class="box-inner homepage-box">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-briefcase"></i> Lo nuevo</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#ofertas">Ultimas Ofertas</a></li>
                    <li><a href="#suscriptores">Suscriptores</a></li>
                    <li><a href="#establecimientos">Establecimientos</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="ofertas">
                        <h3>Ultimas <small>ofertas</small></h3><hr />
                        <div class="alert alert-info">Esta es la lista de las últimas ofertas ingresadas al sistema</div>
                        @if(count($listaOfertas) && Usuario::verificaPermiso('backend/ofertas/listaOfertas'))
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>ESTABLECIMIENTO</th>
                                        <th>ESTADO</th>
                                        <th>INICIA</th>
                                        <th>TERMINA</th>
                                        <th>EXPIRA</th>
                                        <th>VENDIDOS</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>ESTABLECIMIENTO</th>
                                        <th>ESTADO</th>
                                        <th>INICIA</th>
                                        <th>TERMINA</th>
                                        <th>EXPIRA</th>
                                        <th>VENDIDOS</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($listaOfertas as $oferta)
                                        <tr>
                                            <td>{{ $oferta->id }}</td>
                                            <td>{{ $oferta->nombre }}</td>
                                            <td>{{ $oferta->establecimiento->nombre_comercial }}</td>
                                            <td>
                                                @if($oferta->estado == 0)
                                                    <span class="label-danger label label-default">Inactiva</span>
                                                @else
                                                    <span class="label-success label label-default">Activa</span>
                                                @endif
                                            </td>
                                            <td>{{ $oferta->inicio }}</td>
                                            <td>{{ $oferta->fin }}</td>
                                            <td>{{ $oferta->expira }}</td>
                                            <td>{{ $oferta->vendidos }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">No existen ofertas en el sistema</div>
                        @endif
                    </div>
                    <div class="tab-pane" id="suscriptores">
                        <h3>Nuevos <small>suscriptores</small></h3>
                        @if(Usuario::verificaPermiso('backend/suscriptores/listaSuscriptores'))
                            <div class="alert alert-info">
                                Esta es la lista de suscriptores nuevos en el sistema.<br />
                                <strong>Total de suscriptores: </strong>{{ $cantidadSuscriptores }}<br />
                                <strong>Suscritos solo para boletin: </strong>{{ $cantidadSoloBoletin }}<br />
                                <strong>Registrados: </strong>{{ $cantidadRegistrados }}<br />
                                <strong>Compradores: </strong>{{ $cantidadCompradores }}
                            </div>
                        @endif
                        @if(count($listaSuscriptores) && Usuario::verificaPermiso('backend/suscriptores/listaSuscriptores'))
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>E-MAIL</th>
                                        <th>ULTIMA VISITA</th>
                                        <th>ULTIMA COMPRA</th>
                                        <th>CREADO</th>
                                        <th>ESTADO</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>E-MAIL</th>
                                        <th>ULTIMA VISITA</th>
                                        <th>ULTIMA COMPRA</th>
                                        <th>CREADO</th>
                                        <th>ESTADO</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($listaSuscriptores as $suscriptor)
                                        <tr>
                                            <td>{{ $suscriptor->id }}</td>
                                            <td class="center">{{ $suscriptor->nombre }} {{ $suscriptor->apellido }}</td>
                                            <td class="center">{{ $suscriptor->email }}</td>
                                            <td class="center">{{ $suscriptor->ultima_visita }}</td>
                                            <td class="center">{{ $suscriptor->ultima_compra }}</td>
                                            <td class="center">{{ $suscriptor->created_at }}</td>
                                            <td class="center">
                                                @if($suscriptor->estado == 1)
                                                    <span class="label-success label label-default">Activo</span>
                                                @else
                                                    <span class="label-danger label label-default">Inactivo</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">No existen nuevos suscriptores</div>
                        @endif
                    </div>
                    <div class="tab-pane" id="establecimientos">
                        <h3>Nuevos <small>establecimientos</small></h3>
                        <div class="alert alert-info">Esta es la lista de nuevos establecimientos que se han afiliado a cuponcity.com</div>
                        @if(count($listaEstablecimientos) && Usuario::verificaPermiso('backend/establecimientos/listaEstablecimientos'))
                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE COMERCIAL</th>
                                        <th>RAZON SOCIAL</th>
                                        <th>RUC</th>
                                        <th>CREADO</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>ULTIMA VISITA</th>
                                        <th>ULTIMA COMPRA</th>
                                        <th>CREADO</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($listaEstablecimientos as $establecimiento)
                                        <tr>
                                            <td>{{ $establecimiento->id }}</td>
                                            <td class="center">{{ $establecimiento->nombre_comercial }}</td>
                                            <td class="center">{{ $establecimiento->razon_social }}</td>
                                            <td class="center">{{ $establecimiento->ruc }}</td>
                                            <td class="center">{{ $establecimiento->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">No existen nuevos establecimientos</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

<div class="row">
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star"></i> Categorias</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    @if(count($listaCategorias) && Usuario::verificaPermiso('backend/categorias/listaCategorias'))
                        <ul class="dashboard-list">
                        @foreach($listaCategorias as $categoria)
                            <li>{{ $categoria->nombre }}</li>
                        @endforeach
                        </ul>
                    @else
                        <div class="alert alert-warning">No existen categorias en el sistema</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--/span-->
    
    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-globe"></i> Ciudades</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    @if(count($listaCiudades) && Usuario::verificaPermiso('backend/ciudades/listaCiudades'))
                        <ul class="dashboard-list">
                        @foreach($listaCiudades as $ciudad)
                            <li>{{ $ciudad->nombre }}</li>
                        @endforeach
                        </ul>
                    @else
                        <div class="alert alert-warning">No existen ciudades</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--/span-->

    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-shopping-cart"></i> Vendedores</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    @if(count($listaVendedores) && Usuario::verificaPermiso('backend/vendedores/listaVendedores'))
                        <ul class="dashboard-list">
                        @foreach($listaVendedores as $vendedor)
                            <li>{{ $vendedor->nombre }} {{ $vendedor->apellido }}</li>
                        @endforeach
                        </ul>
                    @else
                        <div class="alert alert-warning">No existen vendedores</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--/span-->
    
</div><!--/row-->

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-signal"></i> Resumen de Cupones</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    <div id="resumenVentas"></div>
                    <script type="text/javascript">
                        google.load("visualization", "1.1", {packages:["bar"]});
                        google.setOnLoadCallback(drawStuff);

                        function drawStuff() {
                        var data = new google.visualization.arrayToDataTable([
                          ['Cupones', 'Cantidad'],
                          ["Cupones Vendidos", {{ Transaccion::cuponesVendidos() }}],
                          ["Cupones Redimidos", {{ Transaccion::cuponesRedimidos() }}],
                          ["Cupones Devueltos", {{ Transaccion::cuponesDevueltos() }}]
                        ]);

                        var options = {
                          title: 'Resumen de Cupones',
                          legend: { position: 'none' },
                          chart: { title: 'Resumen de Cupones',
                                   subtitle: '' },
                          bars: 'horizontal', // Required for Material Bar Charts.
                          axes: {
                            x: {
                              0: { side: 'top', label: 'Cantidad'} // Top x-axis.
                            }
                          },
                          bar: { groupWidth: "90%" }
                        };

                        var chart = new google.charts.Bar(document.getElementById('resumenVentas'));
                        chart.draw(data, options);
                        };
                    </script> 
                </div>
            </div>
        </div>
    </div>
    <!--/span-->
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-signal"></i> Resumen de Transacciones</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    <div id="resumenTransacciones"></div>
                    <script type="text/javascript">
                        google.load("visualization", "1.1", {packages:["bar"]});
                        google.setOnLoadCallback(drawStuff);

                        function drawStuff() {
                        var data2 = new google.visualization.arrayToDataTable([
                          ['Transacciones', 'Cantidad'],
                          ["Aprobadas con Tarjeta", {{ Transaccion::aprobadaTarjeta() }}],
                          ["Aprobadas con Creditos", {{ Transaccion::aprobadaCreditos() }}],
                          ["Aprobadas con Paypal ", {{ Transaccion::aprobadaPaypal() }}],
                          ["Aprobadas con Paypal/Creditos ", {{ Transaccion::aprobadaPaypalCreditos() }}],
                          ["No Procesadas con Paypal ", {{ Transaccion::noProcesadaPaypal() }}],
                          ["Canceladas con Paypal ", {{ Transaccion::canceladaPaypal() }}]
                        ]);

                        var options2 = {
                          title: 'Resumen de Transacciones',
                          legend: { position: 'none' },
                          chart: { title: 'Resumen de Transacciones',
                                   subtitle: '' },
                          bars: 'horizontal', // Required for Material Bar Charts.
                          axes: {
                            x: {
                              0: { side: 'top', label: 'Cantidad'} // Top x-axis.
                            }
                          },
                          bar: { groupWidth: "90%" }
                        };

                        var chart2 = new google.charts.Bar(document.getElementById('resumenTransacciones'));
                        chart2.draw(data2, options2);
                        };
                    </script> 
                </div>
            </div>
        </div>
    </div>
    <!--/span-->
</div>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
@stop