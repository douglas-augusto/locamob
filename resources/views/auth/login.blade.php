<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Locamob - Login/Register</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>

        @import url('https://fonts.googleapis.com/css?family=Mukta');

        body {
            font-family: 'Mukta', sans-serif;
            height: 100vh;
            min-height: 550px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow-y: hidden;
        }

        a {
            text-decoration: none;
            color: #444444;
        }

        .login-reg-panel {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            text-align: center;
            width: 70%;
            right: 0;
            left: 0;
            margin: auto;
            height: 400px;
            background-color: #039be5;
        }

        .white-panel {
            background-color: rgba(255, 255, 255, 1);
            height: 500px;
            position: absolute;
            top: -50px;
            width: 50%;
            right: calc(50% - 50px);
            transition: .3s ease-in-out;
            z-index: 0;
            box-shadow: 0 0 15px 9px #00000096;
        }

        .login-reg-panel input[type="radio"] {
            position: relative;
            display: none;
        }

        .login-reg-panel {
            color: #FFF;
        }

        .login-reg-panel #label-login,
        .login-reg-panel #label-register {
            border: 1px solid #FFF;
            padding: 5px 5px;
            width: 150px;
            display: block;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 18px;
        }

        .login-info-box {
            width: 30%;
            padding: 0 50px;
            top: 20%;
            left: 0;
            position: absolute;
            text-align: left;
        }

        .register-info-box {
            width: 30%;
            padding: 0 50px;
            top: 20%;
            right: 0;
            position: absolute;
            text-align: left;

        }

        .right-log {
            right: 50px !important;
        }

        .login-show,
        .register-show {
            z-index: 1;
            display: none;
            opacity: 0;
            transition: 0.3s ease-in-out;
            color: #242424;
            text-align: left;
            padding: 50px;
        }

        .show-log-panel {
            display: block;
            opacity: 0.9;
        }

        .login-show input[type="text"], .login-show input[type="password"] {
            width: 100%;
            display: block;
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #b5b5b5;
            outline: none;
        }

        .login-show input[type="submit"] {
            max-width: 150px;
            width: 100%;
            background: #444444;
            color: #f9f9f9;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            border-radius: 2px;
            float: right;
            cursor: pointer;
        }

        .login-show a {
            display: inline-block;
            padding: 10px 0;
        }

        .register-show input[type="text"], .register-show input[type="password"] {
            width: 100%;
            display: block;
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #b5b5b5;
            outline: none;
        }

        .register-show input[type="submit"] {
            max-width: 150px;
            width: 100%;
            background: #444444;
            color: #f9f9f9;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            border-radius: 2px;
            float: right;
            cursor: pointer;
        }

        .credit {
            position: absolute;
            bottom: 10px;
            left: 10px;
            color: #3B3B25;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            z-index: 99;
        }

        a {
            text-decoration: none;
            color: #2c7715;
        }
    </style>
</head>
<body>
<div class="login-reg-panel">
    <div class="login-info-box">
        <h2>Tem uma conta?</h2>
        <p>Clique em entrar para acessar</p>
        <label id="label-register" for="log-reg-show">Entrar</label>
        <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
    </div>

    <div class="register-info-box">
        <h2>Ainda não tem uma conta?</h2>
        <p>Faça seu registro para acessar o sistema</p>
        <label id="label-login" for="log-login-show">Register</label>
        <input type="radio" name="active-log-panel" id="log-login-show">
    </div>

    <div class="white-panel">
        <div class="login-show">
            <h2 align="center">ACESSAR - LOCAMOB</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="text" placeholder="Email" id="email" name="email" value="{{ old('email') }}"
                       required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" name="password" id="password" placeholder="Senha"
                       required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="submit" value="Login">
            </form>
        </div>
        <div class="register-show">
            <h2 align="center">REGISTRAR - LOCAMOB</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="text" placeholder="Nome" name="name" id="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="text" placeholder="Insira email válido com '@'" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" placeholder="Senha no mínimo 8 caracteres" id="password" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" placeholder="Confirmar Senha" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                <input type="submit" value="Registrar">
            </form>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>

    $(document).ready(function () {
        $('.login-info-box').fadeOut();
        $('.login-show').addClass('show-log-panel');
    });


    $('.login-reg-panel input[type="radio"]').on('change', function () {
        if ($('#log-login-show').is(':checked')) {
            $('.register-info-box').fadeOut();
            $('.login-info-box').fadeIn();

            $('.white-panel').addClass('right-log');
            $('.register-show').addClass('show-log-panel');
            $('.login-show').removeClass('show-log-panel');

        } else if ($('#log-reg-show').is(':checked')) {
            $('.register-info-box').fadeIn();
            $('.login-info-box').fadeOut();

            $('.white-panel').removeClass('right-log');

            $('.login-show').addClass('show-log-panel');
            $('.register-show').removeClass('show-log-panel');
        }
    });
</script>
</body>
</html>
