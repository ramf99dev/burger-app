<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Usuario - MokaFrost</title>
        <link rel="stylesheet" href="{{ asset('css/style_register_user.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
        @laravelPWA
    </head>

    <body>
        <div class="register-container">
            <img src="{{ asset('img/mokalogo.png') }}" alt="Logo MokaFrost" class="register-logo">
            <div class="register-box">
                <a href="{{ route('login') }}" class="back-link">
                    <ion-icon name="arrow-back-outline"></ion-icon> Volver
                </a>
                <h2>Registro de Usuario</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="nombre" name="name" value="{{ old('nombre') }}"
                            placeholder="Ej: María Perez" required>
                    </div>

                    {{-- <div class="input-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" id="cedula" name="cedula" value="{{ old('cedula') }}"
                            placeholder="Ej: 12345678" required>
                    </div> --}}

                    <div class="input-group">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}"
                            placeholder="Ej: 0414-1234567" required>
                    </div>

                    <div class="input-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Ej: correo@ejemplo.com" required>
                    </div>

                    <div class="input-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="********" required>
                    </div>

                    <div class="input-group">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="********" required>
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

                    <button class="btn-register" type="submit">REGISTRARSE</button>
                </form>
            </div>

        </div>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('telefono');

            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    const formatted = formatPhoneNumber(e.target.value);
                    if (formatted !== e.target.value) {
                        e.target.value = formatted;
                    }
                });
            }
        });

        function formatPhoneNumber(value) {
            let phoneNumber = value.replace(/[^\d-]/g, '');

            const parts = phoneNumber.split('-');
            phoneNumber = parts.join('');

            if (phoneNumber.length > 4) {
                phoneNumber = phoneNumber.substring(0, 4) + '-' + phoneNumber.substring(4);
            }

            return phoneNumber;
        }
    </script>

</html>
