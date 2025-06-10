<x-admin-layout>
    <div x-data="{ count: 0 }" class="my-3 w-72 gap-4 space-y-3 place-self-center rounded-lg bg-white shadow md:w-96">
        <form action="{{ route('orden.store') }}" method="POST" class="text-pink-600">
            @csrf
            @if (isset($reserva))
                <input type="hidden" name="reserva_id" value="{{ $reserva->id }}">
            @endif

            @foreach ($categorias as $categoria)
                <div class="m-3 rounded-lg shadow" x-data="{ expanded: false }" x-init="expanded = false"
                    :class="{ 'h-[2.25rem] overflow-hidden': !expanded, 'h-80 overflow-scroll': expanded }" x-cloak>
                    <div class="flex items-center pb-2">

                        <div x-on:click="expanded = !expanded"
                            class="rounded-lg p-1.5 hover:cursor-pointer hover:bg-gray-100" x-show="expanded">

                            <img src="/images/nav-icons/ocultar.svg" alt="" class="h-6">
                        </div>
                        <div x-on:click="expanded = !expanded" class="rounded-lg p-1.5 hover:bg-gray-100"
                            x-show="!expanded">

                            <img src="/images/nav-icons/expandir.svg" alt="" class="h-6">
                        </div>
                        <div class="text-base text-gray-400">{{ $categoria->nombre }} </div>

                    </div>
                    @foreach ($categoria->productos as $producto)
                        <input type="hidden" name="productos[{{ $producto->id }}][id]" value="{{ $producto->id }}">
                        <input type="hidden" name="productos[{{ $producto->id }}][precio]"
                            value="{{ $producto->precio }}">
                        <div class="flex flex-row space-x-4 rounded-lg p-1 transition-all">
                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}"
                                class="aspect-square size-20 rounded-lg">
                            <div class="mb-2 w-full place-content-center space-y-2">
                                <div
                                    class="w-fit rounded-lg bg-yellow-200 bg-opacity-50 p-1.5 text-sm font-medium uppercase tracking-wider text-yellow-800">
                                    {{ $producto->nombre }}
                                </div>
                                <div class="ml-1 flex flex-row items-center justify-between border-0">
                                    <div class="h-fit text-sm font-medium text-black">{{ $producto->precio }}$
                                    </div>
                                    <div class="cantidad flex flex-row items-center rounded-lg border border-pink-600 px-1"
                                        x-data="{ cantidad: 0 }">
                                        <div x-on:click="if(count > 0) count -= {{ $producto->precio }}; if(cantidad > 0) cantidad -= 1 "
                                            x-bind:disabled="cantidad <= 0" class="minus-btn px-1 hover:cursor-pointer">
                                            -</div>
                                        <input
                                            class="w-6 border-0 p-0 text-center [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                            type="number" min="0"
                                            name="productos[{{ $producto->id }}][cantidad]" step="1"
                                            placeholder="0" x-model="cantidad">
                                        <div x-on:click="count = count + {{ $producto->precio }}, cantidad = cantidad + 1"
                                            class="plus-btn px-1 hover:cursor-pointer">+</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

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

            <span class="m-3 ml-4">Total: <span class="font-bold" x-text="count"></span>$</span>
            <div class="mx-3 mt-3 flex flex-row place-content-between gap-4">
                <x-cancel-button ruta="producto.index"></x-cancel-button>
                <x-save-button></x-save-button>
            </div>
        </form>
    </div>
</x-admin-layout>
