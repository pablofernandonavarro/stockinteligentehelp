<x-app-layout>
    <div class="max-w-screen-xl mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                {{-- Mostrar los posts excepto los de la categoría "Stock_interna" para usuarios no autenticados o sin el rol Admin --}}
                @if(auth()->check())
                    @if(auth()->user()->hasRole('Admin'))
                        {{-- Si es Admin, muestra todos los posts --}}
                        <article class="w-full h-80 bg-gray-600 @if($loop->first) md:col-span-2 h-96 @endif rounded-lg overflow-hidden shadow-md flex flex-col justify-between">
                            <div class="px-8 py-4 flex flex-col justify-center flex-grow">
                                <div class="mb-2">
                                    @foreach ($post->etiquetas as $etiqueta)
                                    <a href="{{ route('posts.etiqueta', $etiqueta) }}" class="inline-block px-3 h-6 text-white rounded-full" style="background-color: {{ $etiqueta->color }};">
                                        {{ $etiqueta->name }}
                                    </a>
                                    @endforeach
                                </div>

                                <h1 class="text-2xl md:text-3xl lg:text-4xl text-white leading-8 font-bold">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->name }}
                                    </a>
                                </h1>
                            </div>
                        </article>
                    @else
                        {{-- Si no es Admin, oculta los posts de la categoría "Stock_interna" --}}
                        @if($post->category->name != 'Stock_interna')
                            <article class="w-full h-80 bg-gray-600 @if($loop->first) md:col-span-2 h-96 @endif rounded-lg overflow-hidden shadow-md flex flex-col justify-between">
                                <div class="px-8 py-4 flex flex-col justify-center flex-grow">
                                    <div class="mb-2">
                                        @foreach ($post->etiquetas as $etiqueta)
                                        <a href="{{ route('posts.etiqueta', $etiqueta) }}" class="inline-block px-3 h-6 text-white rounded-full" style="background-color: {{ $etiqueta->color }};">
                                            {{ $etiqueta->name }}
                                        </a>
                                        @endforeach
                                    </div>

                                    <h1 class="text-2xl md:text-3xl lg:text-4xl text-white leading-8 font-bold">
                                        <a href="{{ route('posts.show', $post) }}">
                                            {{ $post->name }}
                                        </a>
                                    </h1>
                                </div>
                            </article>
                        @endif
                    @endif
                @else
                    {{-- Usuarios no autenticados: Oculta los posts de la categoría "Stock_interna" --}}
                    @if($post->category->name != 'Stock_interna')
                        <article class="w-full h-80 bg-gray-600 @if($loop->first) md:col-span-2 h-96 @endif rounded-lg overflow-hidden shadow-md flex flex-col justify-between">
                            <div class="px-8 py-4 flex flex-col justify-center flex-grow">
                                <div class="mb-2">
                                    @foreach ($post->etiquetas as $etiqueta)
                                    <a href="{{ route('posts.etiqueta', $etiqueta) }}" class="inline-block px-3 h-6 text-white rounded-full" style="background-color: {{ $etiqueta->color }};">
                                        {{ $etiqueta->name }}
                                    </a>
                                    @endforeach
                                </div>

                                <h1 class="text-2xl md:text-3xl lg:text-4xl text-white leading-8 font-bold">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->name }}
                                    </a>
                                </h1>
                            </div>
                        </article>
                    @endif
                @endif
            @endforeach
        </div>

        <div class="mt-4 py-4 flex items-center justify-between">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
