<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión - MokaFrost</title>
        <link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
        @laravelPWA
    </head>

    <body>

        <div class="login-container">
            <img src="{{ asset('img/logo.png') }}" alt="MokaFrost Logo" class="login-logo">

            <div class="login-box">
                <h2>Inicio de <span>Sesión</span></h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group">
                        <input type="email" name="email" placeholder="Correo" required>
                        <ion-icon name="mail-outline"></ion-icon>
                    </div>

                    <div class="input-group">
                        <input type="password" name="password" placeholder="*********" required>
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>

                    @if ($errors->any())
                        <div class="message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn-login">INGRESAR
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </button>

                    <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>

                    <a href="{{ route('register') }}">
                        <button type="button" class="btn-register">REGISTRARSE</button>
                    </a>
                </form>

            </div>
        </div>

        <!-- Iconos -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>

</html>
