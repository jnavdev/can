<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema Gami">
    <meta name="keywords" content="Sistema Gami">
    <link rel="shortcut icon" href="{{ asset('assets/frontEnd/img/favicon.png') }}">
    <title>{{ config('app.name') }}</title>

    <!-- Base Styles -->
    <link href="{{ asset('assets/frontEnd/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontEnd/css/style-responsive.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
    <body class="login-body">

        <div class="login-logo" style="background: white">
            <img src="{{ asset('assets/frontEnd/img/can-logo.png') }}">
        </div>

        <h2 class="form-heading">Iniciar sesión</h2>
        <div class="container log-row">
            <form class="form-signin" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                @include('partials.errors')

                <div class="login-wrap">
                    <input type="text" name="email" class="form-control" placeholder="Correo electrónico" autofocus>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                    <button class="btn btn-lg btn-info btn-block" type="submit">Acceder</button>
                </div>
            </form>
        </div>

        <script src="{{ asset('assets/frontEnd/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('assets/frontEnd/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/frontEnd/js/jrespond..min.js') }}"></script>
    </body>
</html>
