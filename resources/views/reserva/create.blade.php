<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Reservas') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="/libs/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="/libs/sweetalert2.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @laravelPWA
    </head>

    <body class="flex place-content-center bg-pink-600">
        <div class="my-3 w-fit gap-4 space-y-3 place-self-center self-center rounded-lg bg-white p-4 shadow md:w-96">
            <form action="{{ route('reserva.store') }}" method="POST" class="text-pink-600">
                @csrf
                <div class="mb-3">
                    <h2 class="text-center text-4xl font-black">Reservación Particular</h2>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col gap-1">
                        <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre Completo"
                            required class="rounded-lg border-2 border-pink-600">
                    </div>

                    <div class="mt-3 flex flex-row items-center gap-1">
                        <label for="fecha">Fecha</label>
                        <input class="rounded border-2 border-pink-600 p-1" type="date" name="fecha">
                    </div>

                    <div class="mt-3 flex flex-row items-center gap-1 space-x-2">
                        <label for="hora">Hora</label>
                        <input class="rounded border-2 border-pink-600 p-1" type="time" min="09:00" max="18:00"
                            name="hora">
                    </div>

                    <div class="mt-3 flex flex-col gap-1">
                        <input class="rounded-lg border-2 border-pink-600" type="number"
                            placeholder="Número de Personas" step="1" min="0" name="numero_personas"
                            value="{{ old('numero_personas') }}" required>
                    </div>

                    <div class="mt-3 flex flex-col gap-1">
                        <select class="rounded-lg border-2 border-pink-600" name="zona_id" required>
                            <option value="" disabled selected>Selecciona una zona</option>
                            @foreach ($zonas as $zona)
                                <option value="{{ $zona->id }}">
                                    {{ $zona->nombre }} - {{ $zona->costo }}$
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lex mt-3 flex-row items-center space-x-2">
                        <label for="orden">¿Desea adjuntar una orden?
                        </label>
                        <input type="hidden" name="orden" value="0">
                        <input class="accent-pink-500" type="checkbox" name="orden" checked value="1" />

                    </div>


                </div>

                @if ($errors->any())
                    <div class="mt-3 rounded-lg p-2 text-start text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="m-3 rounded-lg bg-green-100 p-3 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="m-3 rounded-lg bg-red-100 p-3 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mt-6 flex flex-row place-content-between gap-4">
                    <a href="{{ route('home') }}"
                        class="my-1.5 flex w-fit cursor-pointer items-center rounded-lg bg-gray-400 px-3 py-2 font-medium text-white shadow transition-colors hover:scale-110">
                        <img src="/images/nav-icons/cancelar.svg" alt="" class="h-6">
                        <span class="w52 ml-3 overflow-hidden transition-all">Volver</span>
                    </a>
                    <button
                        class="relative my-1.5 flex w-fit cursor-pointer items-center rounded-lg bg-gradient-to-tr from-yellow-400 to-yellow-400 px-3 py-2 font-medium text-white shadow transition-colors hover:scale-110">
                        <img src="/images/nav-icons/agregar.svg" alt="" class="h-6">
                        <span class="w52 ml-3 overflow-hidden transition-all">Reservar</span>
                    </button>
                </div>
            </form>
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
