<!doctype html>
<html lang="en">
  <head>
  	<title>Inicio de sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('css/login.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.6.3.min.js')}}"></script>

	</head>
	<body style="background-image: url('/fotos/Fondo1.png');background-repeat: no-repeat; background-size: cover;">
    <div class="d-flex align-items-center justify-content-center vh-100">
		<div class="row justify-content-center align-content-center">
            <div class="col-md-12 col-lg-12 menu">
                <h1 class="text-center text-white ">Abarrotera Huachi</h1>
                <h2 class="text-center text-white ">Iniciar sesión</h2>

                <form action="{{route('procesar_login')}}" method="POST">
                {{csrf_field()}}
                    <div class="form-group">
                        <label class="text-white" for="usuario">Usuario:</label>
                        <input required type="usuario" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="password">Contraseña:</label>
                        <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <span class="show-password"><i class="fa fa-eye"></i></span>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mb-4" type="summt">Ingresar</button>
                    </div>
                    @if (Session::has('error'))
                        <div class="alert alert-danger font-italic" role="alert">
                        {{ Session::get('error') }}
                        </div>
                    @else
                        <div class="alert alert-success font-italic" role="alert">
                            {{ Session::get('CerrarSesion')}}
                        </div>
                    @endif
                </form>
            </div>
        </div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.show-password').click(function() {
				var passwordField = $('#password');
				var passwordFieldType = passwordField.attr('type');
				if (passwordFieldType == 'password') {
					passwordField.attr('type', 'text');
					$(this).html('<i class="fa fa-eye-slash"></i>');
				} else {
					passwordField.attr('type', 'password');
					$(this).html('<i class="fa fa-eye"></i>');
				}
			});
		});
	</script>


	</body>
</html>
