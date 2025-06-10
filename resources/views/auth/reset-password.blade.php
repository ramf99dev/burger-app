<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restablecer Contraseña - MokaFrost</title>
        <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
        @laravelPWA
    </head>

    <body>
        <div class="reset-container">
            <div class="reset-box">
                <h2><span>Restablecer</span> <u>Contraseña</u></h2>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="input-group">
                        <input type="email" name="email" value="{{ old('email', $request->email) }}"
                            placeholder="Correo" required autofocus />
                        <ion-icon name="mail-outline"></ion-icon>
                    </div>

                    <div class="input-group">
                        <input type="password" name="password" placeholder="Nueva contraseña" required />
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </div>

                    <div class="input-group">
                        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña"
                            required />
                        <ion-icon name="lock-open-outline"></ion-icon>
                    </div>

                    @error('email')
                        <div class="message">{{ $message }}</div>
                    @enderror

                    @error('password')
                        <div class="message">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn-enviar">CAMBIAR CONTRASEÑA</button>
                </form>

                <a href="{{ route('login') }}" class="volver-link">
                    <ion-icon name="arrow-back-outline"></ion-icon> Volver al login
                </a>
            </div>
        </div>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>

</html>
