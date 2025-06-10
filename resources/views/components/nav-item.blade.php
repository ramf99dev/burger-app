<a href="{{ route($ruta) }}">
    <li x-data
        class="{{ $active ? 'bg-yellow-400 text-yellow-800' : 'hover:bg-yellow-100 text-gray-600' }} mx-1 my-1.5 flex cursor-pointer items-center overflow-hidden rounded-md px-2 py-2 font-medium transition-colors md:mx-3">
        @if ($active)
            <img src="{{ $img . '-selected.svg' }}" alt="" class="h-6">
        @else
            <img src="{{ $img . '.svg' }}" alt="" class="h-6">
        @endif

        <span class="overflow-hidden transition-all"
            :class="{ 'ml-3 w52': expanded, 'w-0': !expanded }">{{ $titulo }}</span>
    </li>
</a>
