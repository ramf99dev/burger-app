<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MokaFrost</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        @laravelPWA
    </head>

    <body>

        @guest
            <div class="float">
                <a href="/login">Iniciar Sesión</a>
            </div>
        @endguest
        @auth
            @if (Auth::user()->permiso === 2)
                <div class="float">
                    <a href="{{ route('reserva.index') }}">Reservas</a>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf 
                     <button type="submit">Cerrar sesión</button>
                    </form>
                </div>
            @elseif (Auth::user()->permiso === 0 || Auth::user()->permiso === 1)
                <div class="float">
                    <a href="/producto">Panel</a>
                </div>
            @endif
        @endauth

        <div class="header">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/mokalogo.png') }}" alt="MokaFrost Logo" class="logo">
            </a>
        </div>




        <div class="products">
            <div class="product-card">
                <img src="{{ asset('img/producto1.jpg') }}" alt="Producto 1">
            </div>
            <div class="product-card">
                <img src="{{ asset('img/producto2.jpg') }}" alt="Producto 2">
            </div>
            <div class="product-card">
                <img src="{{ asset('img/producto3.jpg') }}" alt="Producto 3">
            </div>
        </div>

        <div class="cta">
            <div class="cta-content">
                <div class="cta-text">
                    <p>¿Quieres <span class="highlight2">RESERVAR</span> y conocer nuestro <span
                            class="highlight2">MENÚ</span>?</p>
                    @guest
                        <a href="{{ route('login') }}">
                            <button class="button">INICIAR SESIÓN</button>
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('reserva.create') }}">
                            <button class="button">Reservar</button>
                        </a>
                    @endauth
                </div>
                <div class="cta-image">
                    <img src="{{ asset('img/chica.png') }}" alt="Chica">
                </div>
            </div>
        </div>

        <div class="about">
            <div class="about-content">
                <div class="about-image">
                    <img src="{{ asset('img/Somos.png') }}" alt="Somos">
                </div>
                <div class="about-text">
                    <h2>¿Quiénes Somos?</h2>
                    <p>
                        En MokaFrost, te ofrecemos una amplia variedad de sabores en granizados frescos,
                        preparados con ingredientes de la mejor calidad y a precios irresistibles.
                        Elige tu <span class="highlight">SABOR</span>, tamaño y Topping <span
                            class="highlight">FAVORITO</span>
                        y vive la experiencia del <span class="highlight">FRÍO PLACER</span>.
                    </p>
                </div>
            </div>
        </div>

        <div class="espacios">
            <h2>Nuestros <span>espacios</span></h2>
            <div class="espacios-container">
                <img src="{{ asset('img/mapa.png') }}" alt="Plano de espacios" class="plano-img">
                <div class="tag general">General 1$</div>
                <div class="tag terraza">Terraza 0$</div>
                <div class="tag privada">Privada 2$</div>
                <div class="tag vip">VIP 3$</div>
            </div>
        </div>

        <div class="horarios">
            <h2>Horarios de Atención</h2>
            <p>Lunes a Viernes: <span class="highlight">9:00 AM - 9:00 PM</span></p>
            <p>Sábados y Domingos: <span class="highlight">8:00 AM - 10:00 PM</span></p>
        </div>

        <footer class="footer">
            <ul class="social-icons">
                <li><a href="https://www.instagram.com/mokafrost" target="_blank"><ion-icon
                            name="logo-instagram"></ion-icon></a></li>
                <li><a href="https://wa.me/584123456789" target="_blank"><ion-icon name="logo-whatsapp"></ion-icon></a>
                </li>
                <li><a href="https://www.tiktok.com/@mokafrost" target="_blank"><ion-icon
                            name="logo-tiktok"></ion-icon></a></li>
            </ul>
            <p>Síguenos en nuestras Redes Sociales</p>
            <p>&copy; 2025 | Todos los derechos reservados</p>
        </footer>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>

</html>
