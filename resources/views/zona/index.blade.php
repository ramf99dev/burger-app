<x-admin-layout>
    <x-search-bar ruta="zona"></x-search-bar>
    <div class="mt-3 grid w-full grid-cols-1 gap-4 text-wrap md:grid-cols-2">
        @foreach ($zonas as $zona)
            <div>
                <div class="space-y-3 rounded-lg bg-white p-4 shadow">
                    <div class="flex items-baseline space-x-2 text-xl">
                        <div
                            class="rounded-lg bg-yellow-200 bg-opacity-50 p-1.5 text-lg font-medium uppercase tracking-wider text-yellow-800">
                            {{ $zona->nombre }}
                        </div>
                        <div class="text-sm font-medium text-black">
                            {{ $zona->numero_personas }} personas
                        </div>
                    </div>
                    <div class="flex place-content-between">
                        <div class="mb-1 text-xl font-medium text-black">
                            {{ $zona->costo }}$
                        </div>
                        <div>
                            <a class="inline-block" href="{{ route('zona.edit', $zona) }}"><img class="h-4"
                                    src="/images/nav-icons/editar.svg" alt=""></a>
                            <form class="inline-block" action="{{ route('zona.destroy', $zona) }}" method="POST">
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
        {{ $zonas->links('vendor.pagination.simple-tailwind') }}
    </div>

</x-admin-layout>
