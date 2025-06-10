<div x-data="{ expanded: true }" x-init="expanded = true">
    <aside class="h-full w-48" :class="{ 'w-48': expanded, 'w-25': !expanded }">
        <nav class="flex h-full flex-col border-r bg-white shadow-sm">
            <div class="flex items-center justify-between p-4 pb-2">
                <img src="/images/mokalogopink.png" alt=""
                    class="overflow-hidden rounded-lg bg-yellow-200 bg-opacity-50 p-1.5 transition-all"
                    :class="{ 'w-32': expanded, 'w-0': !expanded }">
                <button @click="expanded = !expanded" class="rounded-lg p-1.5 hover:bg-gray-100" x-show="expanded">

                    <img src="/images/nav-icons/arrow-left.svg" alt="" class="h-6">
                </button>
                <button @click="expanded = !expanded" class="rounded-lg p-1.5 hover:bg-gray-100" x-show="!expanded">

                    <img src="/images/nav-icons/arrow-right.svg" alt="" class="h-6">
                </button>

            </div>
            <ul x-bind:Iexpanded="expanded">
                <x-nav-item titulo="Productos" ruta="producto.index" img="/images/nav-icons/productos"></x-nav-item>
                @if (Auth::user()->permiso === 0)
                    <x-nav-item titulo="Categorias" ruta="categoria.index"
                        img="/images/nav-icons/categorias"></x-nav-item>
                    <x-nav-item titulo="Usuarios" ruta="usuario.index" img="/images/nav-icons/usuarios"></x-nav-item>
                    <x-nav-item titulo="Zonas" ruta="zona.index" img="/images/nav-icons/zonas"></x-nav-item>
                @endif
                <x-nav-item titulo="Ordenes" ruta="orden.index" img="/images/nav-icons/ordenes"></x-nav-item>
                <x-nav-item titulo="Reservas" ruta="reserva.index" img="/images/nav-icons/reservas"></x-nav-item>
                <x-nav-item titulo="Volver" ruta="dashboard" img="/images/nav-icons/volver"></x-nav-item>
                <div>
                    <form method="POST" action="{{ route('logout') }}"
                        class="mx-1 my-1.5 flex cursor-pointer items-center overflow-hidden rounded-md px-2 py-2 font-medium text-gray-600 transition-colors hover:bg-yellow-100 md:mx-3">
                        @csrf
                        <img src="/images/nav-icons/cerrar-sesion.svg" alt="" class="h-6">
                        <button type="submit" class="overflow-hidden transition-all"
                            :class="{ 'ml-3 w52': expanded, 'w-0': !expanded }">Cerrar
                            Sesión</button>
                    </form>
                </div>

                {{-- 
                
                
                <x-nav-item titulo="Estadisticas" ruta="estadisticas.index"
                    img="/images/nav-icons/estadisticas"></x-nav-item> --}}
            </ul>
        </nav>
    </aside>
</div>
