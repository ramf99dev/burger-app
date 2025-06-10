<div class="flex w-full flex-row place-items-center justify-between">
    <x-add-button :ruta=$ruta></x-add-button>
    <form class="flex w-full flex-row place-items-center" action="{{ route($ruta . '.index') }}" method="GET">
        <input name="buscar" type="text" class="h-10 w-full rounded-lg border-pink-600 py-4" placeholder="Buscar...">
        <button
            class="relative -ml-10 inline-block size-8 cursor-pointer justify-center rounded-lg bg-gradient-to-tr from-yellow-400 to-yellow-400 p-2 shadow transition-colors hover:scale-110">
            <img src="/images/nav-icons/buscar.svg" alt="" class="h-full place-self-center">
        </button>
    </form>
</div>
