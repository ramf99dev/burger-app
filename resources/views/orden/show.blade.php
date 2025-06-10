<x-admin-layout>
    <div class="my-3 w-72 gap-4 space-y-3 place-self-center rounded-lg bg-white p-4 text-center shadow md:w-96">
        <h2 class="text-2xl font-extrabold text-pink-600">Orden #{{ $orden->id }}</h2>
    </div>
    <div class="mb-3 w-72 gap-4 space-y-3 place-self-center rounded-lg bg-white p-4 shadow md:w-96">
        <div class="font-medium">
            <p>Fecha: <span class="font-normal text-pink-600">{{ $orden->created_at->format('d M Y') }}</span></p>
            <div class="flex flex-row items-center space-x-2">
                <div>
                    Estado:
                </div>
                @if ($orden->estado === 'pendiente')
                    <div
                        class="rounded-lg bg-yellow-200 bg-opacity-50 p-1.5 text-sm font-medium uppercase tracking-wider text-yellow-800">
                        {{ $orden->estado }}
                    </div>
                @elseif ($orden->estado === 'completada')
                    <div
                        class="rounded-lg bg-green-200 bg-opacity-50 p-1.5 text-sm font-medium uppercase tracking-wider text-green-800">
                        {{ $orden->estado }}
                    </div>
                @endif
            </div>
        </div>

        <hr>
        <div class="flex flex-col">
            <h2 class="text-xl font-extrabold">Resumen</h2>
            @foreach ($orden->ordenProductos as $ordenProducto)
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
        </div>

        <hr>

        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-extrabold">Total</h2>
            <h2 class="text-xl font-extrabold text-pink-600">{{ number_format($orden->total, 2) }}$</p>
        </div>
        <div class="mt-6 flex flex-row place-content-between gap-4">
            <x-cancel-button ruta="orden.index"></x-cancel-button>
        </div>
    </div>

</x-admin-layout>
