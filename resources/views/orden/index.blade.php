<x-admin-layout>
    <x-search-bar ruta="orden"></x-search-bar>
    <div class="mt-3 grid w-full grid-cols-1 gap-4 text-wrap md:grid-cols-2">
        @foreach ($ordenes as $orden)
            <div class="space-y-3 rounded-lg bg-white p-4 shadow">
                <div class="flex items-baseline space-x-2 text-xl">
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-row items-center space-x-2">
                            @if ($orden->estado === 'pendiente')
                                <div
                                    class="rounded-lg bg-yellow-200 bg-opacity-50 p-1.5 text-lg font-medium uppercase tracking-wider text-yellow-800">
                                    {{ $orden->estado }}
                                </div>
                            @elseif ($orden->estado === 'completada')
                                <div
                                    class="rounded-lg bg-green-200 bg-opacity-50 p-1.5 text-lg font-medium uppercase tracking-wider text-green-800">
                                    {{ $orden->estado }}
                                </div>
                            @endif
                            <div>
                                <h2>Orden #{{ $orden->id }}</h2>
                            </div>
                            @if ($orden->reserva)
                                <div class="flex h-fit flex-row text-xs text-gray-400">
                                    <a href="{{ route('reserva.show', $orden->reserva) }}">Pertenece a una reserva</a>
                                </div>
                            @endif



                        </div>
                        <div class="flex h-fit flex-row text-xs text-gray-400">
                            @if ($orden->user->permiso === 0)
                                Administrador:
                            @elseif($orden->user->permiso === 1)
                                Empleado:
                            @elseif ($orden->user->permiso === 2)
                                Cliente:
                            @endif
                            {{ $orden->user->name }}
                        </div>
                        <div class="overflow-y-auto text-wrap text-xs text-gray-500">
                            {{ $orden->created_at->isoFormat('LL') }}.
                            {{ $orden->created_at->diffForHumans() }}
                        </div>

                        <div class="overflow-y-auto text-wrap text-xs text-gray-700">
                            @foreach ($orden->ordenProductos as $ordenProducto)
                                {{ $ordenProducto->cantidad }}
                                {{ $ordenProducto->producto->nombre }}.
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="flex place-content-between place-items-center">
                    <div class="mb-1 text-xl font-medium text-black">
                        {{ $orden->total }}$
                    </div>
                    <div class="justify-center">
                        <a class="inline-block" href="{{ route('orden.show', $orden) }}"><img class="h-4"
                                src="/images/nav-icons/detalles.svg" alt=""></a>
                        <a class="inline-block" href="{{ route('orden.edit', $orden) }}"><img class="h-4"
                                src="/images/nav-icons/editar.svg" alt=""></a>
                        <form class="inline-block" action="{{ route('orden.destroy', $orden) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirmation(event)">
                                <img class="h-4" src="/images/nav-icons/borrar.svg" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-6">
            {{ $ordenes->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</x-admin-layout>
