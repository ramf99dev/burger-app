<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Panel de Control') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="/libs/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="/libs/sweetalert2.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @laravelPWA
    </head>

    <body class="flex min-h-screen flex-row bg-pink-600">
        @if (!(Auth::user()->permiso === 2))
            @include('components.sidebar')
        @endif
        <div class="m-2 flex w-full flex-col place-items-center">
            {{ $slot }}
        </div>
    </body>

    <script>
        function confirmation(ev) {
            ev.preventDefault();
            const form = ev.currentTarget.closest('form');

            Swal.fire({
                title: "¿Esta seguro de eliminar esto?",
                text: "No podra ser revertido",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Confirmar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#facc15",
                cancelButtonColor: "#9ca3af"

            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function cancel(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');

            Swal.fire({
                title: "¿Esta seguro?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Confirmar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#facc15",
                cancelButtonColor: "#9ca3af"

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToRedirect;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const numberInputs = document.querySelectorAll('input[type="number"]');

            numberInputs.forEach(input => {
                input.addEventListener('keydown', function(e) {
                    const allowedKeys = [
                        'Backspace', 'Delete', 'Tab', 'Escape', 'Enter',
                        'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown'
                    ];

                    if ((e.ctrlKey || e.metaKey) && ['a', 'c', 'x', 'v'].includes(e.key
                            .toLowerCase())) {
                        return;
                    }

                    // Bloquea en caso de que no sea un numero o una tecla permitida
                    if (!/^\d$/.test(e.key) && !allowedKeys.includes(e.key)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>

</html>
