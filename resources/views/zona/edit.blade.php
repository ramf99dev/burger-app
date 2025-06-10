<x-admin-layout>
    <div class="my-3 w-fit gap-4 space-y-3 place-self-center self-center rounded-lg bg-white p-4 shadow md:w-96">
        <form action="{{ route('zona.update', $zona) }}" method="POST" class="text-pink-600">
            @csrf
            @method('PUT')
            <div class="mt-3 flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="{{ $zona->nombre }}" required
                        class="rounded-lg border-pink-600">
                </div>

                <div class="mt-3 flex flex-col gap-1">
                    <label for="numero_personas">Numero de Personas</label>
                    <input class="rounded-lg border-pink-600" type="number" step="1" min="0"
                        name="numero_personas" value="{{ $zona->numero_personas }}" required>
                </div>

                <div class="mt-3 flex flex-col gap-1">
                    <label for="costo">Costo</label>
                    <input class="rounded-lg border-2 border-pink-600" type="number" step="0.01" min="0"
                        name="costo" value="{{ $zona->costo }}" required>
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

            <div class="mt-9 flex flex-row place-content-between gap-4">
                <x-cancel-button ruta="zona.index"></x-cancel-button>
                <x-save-button></x-save-button>
            </div>
        </form>
    </div>

</x-admin-layout>
