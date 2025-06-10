<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recuperar Contraseña - MokaFrost</title>
        <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        @laravelPWA
    </head>

    <body>
        <div class="forgot-container">
            <div class="forgot-box">
                <h2>Recuperar <span>Contraseña</span></h2>
                @if (session('status'))
                    <div class="message">{{ session('status') }}</div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Correo" required autofocus>
                        <ion-icon name="mail-outline"></ion-icon>
                    </div>
                    <button type="submit" class="btn-enviar">ENVIAR ENLACE</button>
                    <a href="{{ route('login') }}" class="volver-link"><ion-icon name="arrow-back-outline"></ion-icon>
                        Volver al login</a>
                </form>
            </div>
        </div>
    </body>

</html>
