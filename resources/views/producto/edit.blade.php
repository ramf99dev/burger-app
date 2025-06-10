<x-admin-layout>
    <div class="my-3 w-fit gap-4 space-y-3 place-self-center self-center rounded-lg bg-white p-4 shadow md:w-96">
        <form action="{{ route('producto.update', $producto) }}" method="POST" class="text-pink-600"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-3 flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="{{ $producto->nombre }}" required
                        class="rounded-lg border-2 border-pink-600">
                </div>

                <div class="mt-3 flex flex-col gap-1">
                    <label for="descripcion">Descripción</label>
                    <textarea class="resize-none rounded-lg border-2 border-pink-600" name="descripcion" id="" required
                        rows="5">{{ $producto->descripcion }}</textarea>
                </div>

                <div class="mt-3 flex flex-col gap-1">
                    <label for="categoria">Categoria</label>
                    <select class="rounded-lg border-2 border-pink-600" name="categoria_id" required>
                        <option value="{{ $producto->categoria->id }}" selected>
                            {{ $producto->categoria->nombre }}
                        </option>
                        @foreach ($categorias as $categoria)
                            @if ($categoria != $producto->categoria)
                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->nombre }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 flex flex-col gap-1">
                    <label for="precio">Precio</label>
                    <input class="rounded-lg border-2 border-pink-600" type="number" step="0.01" min="0"
                        name="precio" value="{{ $producto->precio }}" required>
                </div>
            </div>

            <div class="mt-3 flex flex-col gap-1">
                <label for="imagen">Imagen</label>
                <input required class="rounded-lg border-2 border-pink-600" type="file" name="imagen"
                    id="imagen">
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
                <x-cancel-button ruta="producto.index"></x-cancel-button>
                <x-save-button></x-save-button>
            </div>


        </form>
    </div>

</x-admin-layout>
