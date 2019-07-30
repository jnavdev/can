<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="codificadev" />
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/frontEnd/img/favicon.png') }}">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/frontEnd/js/vector-map/jquery-jvectormap-1.1.1.css') }}">
    <link href="{{ asset('assets/frontEnd/css/slidebars.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/js/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('assets/frontEnd/js/jquery-ui/jquery-ui-1.10.1.custom.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontEnd/js/icheck/skins/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/css/owl.carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontEnd/css/jquery.steps.css') }}" />
    <link href="{{ asset('assets/frontEnd/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/css/style-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/bootstrap-fileinput/css/fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/bootstrap-fileinput/themes/explorer/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/js/toastr-master/build/toastr.min.css') }}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    @yield('styles')
</head>

<body class="sticky-header">
<section>
    <!-- sidebar left start-->
    <div class="sidebar-left">
        <!--responsive view logo start-->
        <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/frontEnd/img/can-logo.png') }}" alt="Logo CAN" class="img-responsive" style="width: 100px">
                <!--<i class="fa fa-maxcdn"></i>-->
                <span class="brand-name">CAN</span>
            </a>
        </div>
        <!--responsive view logo end-->

        <div class="sidebar-left-info">
            <!-- visible small devices start-->
            <div class=" search-field">  </div>
            <!-- visible small devices end-->

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked side-navigation">
                <li>
                    <h3 class="navigation-title">Menú</h3>
                </li>



                <li class="@if (Request::is('/')) active @endif"><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

                @if (Auth::user()->role_id == 1)
                    <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>Cotizaciones</span></a>
                        <ul class="child-list">
                            <li class="@if (Request::is('cotizacion-simple')) active @endif"><a href="{{ url('cotizacion-simple') }}"> Nueva cotización</a></li>
                            <li class="@if (Request::is('cotizaciones')) active @endif"><a href="{{ url('cotizaciones') }}"> Vigentes</a></li>
                            <li class="@if (Request::is('cotizaciones/cerradas')) active @endif"><a href="{{ url('cotizaciones/cerradas') }}"> Cerradas</a></li>
                            <li class="@if (Request::is('cotizaciones/caducadas')) active @endif"><a href="{{ url('cotizaciones/caducadas') }}"> Caducadas</a></li>
                        </ul>
                    </li>

                    <li class="menu-list"><a href=""><i class="fa fa-suitcase"></i> <span>Negocios</span></a>
                        <ul class="child-list">
                            <li class="@if (Request::is('nuevo-negocio')) active @endif"><a href="{{ url('nuevo-negocio') }}"> Nuevo negocio</a></li>
                            <li class="@if (Request::is('negocios')) active @endif"><a href="{{ url('negocios') }}">Vigentes</a></li>
                            <li class="@if (Request::is('negocios/cerrados')) active @endif"><a href="{{ url('negocios/cerrados') }}"> Cerrados</a></li>
                            {{-- <li class="@if (Request::is('negocios/facturados')) active @endif"><a href="{{ url('negocios/facturados') }}"> Facturados</a></li> --}}
                        </ul>
                    </li>

                    <li class="menu-list"><a href=""><i class="fa fa-users"></i> <span>Clientes</span></a>
                        <ul class="child-list">
                            <li class="@if (Request::is('nuevo-negocio')) active @endif"><a href="{{ url('crear-cliente') }}"> Crear nuevo</a></li>
                            <li class="@if (Request::is('clientes')) active @endif"><a href="{{ url('clientes') }}"> Ver listado</a></li>
                        </ul>
                    </li>

                    <li class="menu-list"><a href=""><i class="fa fa-users"></i> <span>Usuarios</span></a>
                        <ul class="child-list">
                            <li class="@if (Request::is('nuevo-usuario')) active @endif"><a href="{{ url('crear-usuario') }}"> Crear nuevo</a></li>
                            <li class="@if (Request::is('usuarios')) active @endif"><a href="{{ url('usuarios') }}"> Ver listado</a></li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role_id == 3)
                    <li class="menu-list"><a href=""><i class="fa fa-suitcase"></i> <span>Negocios</span></a>
                        <ul class="child-list">
                            <li class="@if (Request::is('nuevo-negocio')) active @endif"><a href="{{ url('nuevo-negocio') }}"> Nuevo negocio</a></li>
                            <li class="@if (Request::is('negocios')) active @endif"><a href="{{ url('negocios') }}">Vigentes</a></li>
                            <li class="@if (Request::is('negocios/cerrados')) active @endif"><a href="{{ url('negocios/cerrados') }}"> Cerrados</a></li>
                            {{-- <li class="@if (Request::is('negocios/facturados')) active @endif"><a href="{{ url('negocios/facturados') }}"> Facturados</a></li> --}}
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role_id == 5)
                    <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>Cotizaciones</span></a>
                        <ul class="child-list">
                            <li class="@if (Request::is('cotizacion-simple')) active @endif"><a href="{{ url('cotizacion-simple') }}"> Nueva cotización</a></li>
                            <li class="@if (Request::is('cotizaciones')) active @endif"><a href="{{ url('cotizaciones') }}"> Vigentes</a></li>
                            <li class="@if (Request::is('cotizaciones/cerradas')) active @endif"><a href="{{ url('cotizaciones/cerradas') }}"> Cerradas</a></li>
                            <li class="@if (Request::is('cotizaciones/caducadas')) active @endif"><a href="{{ url('cotizaciones/caducadas') }}"> Caducadas</a></li>
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->rooms->count() > 0)
                    <li class="menu-list"><a href=""><i class="fa fa-user"></i> <span>Online Meeting</span></a>
                        <ul class="child-list">
                            @foreach (auth()->user()->rooms as $room)
                                <li><a href="{{ url("chat/{$room->slug}") }}"> {{ $room->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- sidebar left end-->

    <!-- body content start-->
    <div class="body-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--logo and logo icon start-->
            <div class="logo dark-logo-bg hidden-xs hidden-sm">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/frontEnd/img/can-logo.png') }}" alt="Logo CAN" style="width: 100px">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name">CAN</span>
                </a>
            </div>

            <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/frontEnd/img/can-logo.png') }}" alt="Logo CAN" style="width: 40px">
                    <!--<i class="fa fa-maxcdn"></i>-->
                </a>
            </div>
            <!--logo and logo icon end-->

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
            <!--toggle button end-->
            <div class="notification-wrap">
                <!--right notification start-->
                <div class="right-notification">
                    <ul class="notification-menu">
                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ Auth::user()->profile_picture }}" alt="">{{ Auth::user()->full_name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                <li><a href="{{ url('perfil') }}"> Mi perfil</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </div>
                <!--right notification end-->
            </div>

        </div>
        <!-- header section end-->


        <!--body wrapper start-->
        <div class="wrapper">
            @yield('content')
        </div>
        <!--body wrapper end-->


        <!--footer section start-->
        <footer>
            {{ Carbon\Carbon::now()->year }} &copy; Todos los derechos reservados. Desarrollado por <a href="https://codificadev.cl/" target="_blank">codificadev</a>.
        </footer>
        <!--footer section end-->
    </div>
    <!-- body content end-->
</section>

<script src="{{ asset('assets/frontEnd/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/jquery-migrate.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/frontEnd/js/slidebars.min.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/switchery/switchery-init.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/sparkline/jquery.sparkline.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/sparkline/sparkline-init.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/bootstrap-validator.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/frontEnd/js/jquery.steps.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/frontEnd/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/frontEnd/js/wizard-init.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/frontEnd/js/select2.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/scripts.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/frontEnd/bootstrap-fileinput/js/fileinput.js') }}"></script>
<script src="{{ asset('assets/frontEnd/bootstrap-fileinput/themes/explorer/theme.js') }}"></script>
<script src="{{ asset('assets/frontEnd/rut/rut.js') }}"></script>
<script src="{{ asset('assets/frontEnd/js/toastr-master/build/toastr.min.js') }}"></script>
<script>
    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "5000",
            "timeOut": "5000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $.get('{{ url('comprobar-mensajes') }}', function (data) {
            if (data['success'] === true) {
                $.each(data['rooms'], function (index, value) {
                    toastr.warning('Mensajes sin leer en: ' + value['name'], 'Click para abrir', {
                        onclick: function () {
                            window.location.replace(value['url']);
                        }
                    });
                });
            }
        });
    });
</script>

@yield('scripts')
</body>
</html>
