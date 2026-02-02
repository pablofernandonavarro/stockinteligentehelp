<div class="relative hidden md:block" x-data="{ open: @entangle('showResults') }" @click.away="open = false">
    <input
        type="text"
        wire:model.live.debounce.300ms="search"
        @focus="open = $wire.search.length >= 2"
        class="block w-80 p-2 text-sm bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500"
        placeholder="Buscar..."
    />

    <!-- Icono de búsqueda / Loading -->
    <div class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-200">
        <svg wire:loading.remove wire:target="search" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <svg wire:loading wire:target="search" class="w-5 h-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>

    <!-- Resultados del dropdown -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="absolute z-50 mt-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 max-h-96 overflow-y-auto"
    >
        @if($posts->count() > 0)
            @foreach($posts as $post)
                <a
                    href="{{ route('posts.show', $post) }}"
                    class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700 last:border-b-0"
                >
                    <div class="flex items-start gap-2">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $post->name }}
                            </p>
                            @if($post->etiquetas->count() > 0)
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($post->etiquetas->take(3) as $etiqueta)
                                        <span
                                            class="inline-block px-2 py-0.5 text-xs text-white rounded-full"
                                            style="background-color: {{ $etiqueta->color }};"
                                        >
                                            {{ $etiqueta->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $post->category->name }}
                        </span>
                    </div>
                </a>
            @endforeach

            <!-- Ver todos los resultados -->
            <a
                href="{{ route('posts.index', ['search' => $search]) }}"
                class="block px-4 py-3 text-center text-sm text-blue-600 dark:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium"
            >
                Ver todos los resultados
            </a>
        @else
            <div class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 text-center">
                No se encontraron resultados para "{{ $search }}"
            </div>
        @endif
    </div>
</div>
