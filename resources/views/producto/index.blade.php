<x-admin-layout>
    <x-search-bar ruta="producto"></x-search-bar>
    <div class="mt-3 grid grid-cols-1 gap-4 text-wrap md:grid-cols-2 lg:grid-cols-4">
        @foreach ($productos as $producto)
            <div class="flex h-96 w-64 flex-col rounded-lg bg-white text-center shadow">
                <div class="size-full h-32 overflow-hidden">
                    <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="rounded-t-lg">
                </div>
                <div class="flex h-64 flex-col justify-between space-y-2 p-4">
                    <div class="space-y-2">
                        <div
                            class="rounded-lg bg-yellow-200 bg-opacity-50 p-1.5 text-lg font-medium uppercase tracking-wider text-yellow-800">
                            {{ $producto->nombre }}
                        </div>
                        <div class="text-base text-gray-400">
                            {{ $producto->categoria->nombre }}
                        </div>
                        <div class="h-20 overflow-y-auto text-wrap text-xs text-gray-700">
                            {{ $producto->descripcion }}
                        </div>
                    </div>

                    <div class="flex place-content-between place-items-center">
                        <div class="mb-1 text-xl font-medium text-black">
                            {{ $producto->precio }}$
                        </div>
                        <div class="justify-center">
                            <a class="inline-block" href="{{ route('producto.edit', $producto) }}"><img class="h-4"
                                    src="/images/nav-icons/editar.svg" alt=""></a>
                            <form class="inline-block" action="{{ route('producto.destroy', $producto) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmation(event)">
                                    <img class="h-4" src="/images/nav-icons/borrar.svg" alt="">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="mt-6">
        {{ $productos->links('vendor.pagination.simple-tailwind') }}
    </div>



</x-admin-layout>
