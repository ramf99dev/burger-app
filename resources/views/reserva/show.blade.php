<x-admin-layout>
    <div class="my-3 w-72 gap-4 space-y-3 place-self-center rounded-lg bg-white p-4 text-center shadow md:w-96">
        <h2 class="text-2xl font-extrabold text-pink-600">Mi Reserva</h2>
    </div>
    <div class="mb-3 w-72 gap-4 space-y-3 place-self-center rounded-lg bg-white p-4 shadow md:w-96">
        <div class="font-medium">
            <p>Fecha: <span class="font-normal text-pink-600">{{ $reserva->fecha }}</span></p>
            <p>Hora: <span class="font-normal text-pink-600">{{ $reserva->hora }}</span></p>
            <div class="flex flex-row items-center space-x-2">
                <div>
                    Estado:
                </div>
                @if ($reserva->estado === 'pendiente')
                    <div
                        class="rounded-lg bg-yellow-200 bg-opacity-50 p-1.5 text-sm font-medium uppercase tracking-wider text-yellow-800">
                        {{ $reserva->estado }}
                    </div>
                @elseif ($reserva->estado === 'completada')
                    <div
                        class="rounded-lg bg-green-200 bg-opacity-50 p-1.5 text-sm font-medium uppercase tracking-wider text-green-800">
                        {{ $reserva->estado }}
                    </div>
                @endif
            </div>
        </div>

        <hr>
        <div class="flex flex-col space-y-2">
            <h2 class="text-xl font-extrabold">Resumen</h2>
            @if ($reserva->orden)
                @foreach ($reserva->orden->ordenProductos as $ordenProducto)
                    <div class="mx-3 flex flex-row justify-between">
                        <div>
                            {{ $ordenProducto->producto->nombre }}
                            x{{ $ordenProducto->cantidad }}
                        </div>
                        <div>
                            {{ number_format($ordenProducto->producto->precio, 2) }}$
                        </div>
                    </div>
                @endforeach
            @endif
            <hr>
            <div class="mx-3 flex flex-row justify-between">
                <div>
                    {{ $reserva->zona->nombre }}
                </div>
                <div>
                    {{ number_format($reserva->zona->costo, 2) }}$
                </div>
            </div>
        </div>

        <hr>

        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-extrabold">Total</h2>
            @if ($reserva->orden)
                <h2 class="text-xl font-extrabold text-pink-600">
                    {{ number_format($reserva->orden->total + $reserva->zona->costo, 2) }}$
                </h2>
            @else
                <h2 class="text-xl font-extrabold text-pink-600">
                    {{ number_format($reserva->zona->costo, 2) }}$
                </h2>
            @endif
        </div>
        <div class="mt-6 flex flex-row place-content-between gap-4">
            <div class="w-fit">
                <a href="{{ route('reserva.index') }}" onclick="cancel(event)"
                    class="relative my-1.5 flex cursor-pointer items-center rounded-lg bg-gray-400 px-3 py-2 font-medium text-white shadow transition-colors hover:scale-110">
                    <img src="/images/nav-icons/cancelar.svg" alt="" class="h-6">
                    <span class="w52 ml-3 overflow-hidden transition-all">Volver</span>
                </a>
            </div>
        </div>
    </div>

</x-admin-layout>
